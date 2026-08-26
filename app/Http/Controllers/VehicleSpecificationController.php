<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Pool;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Throwable;

class VehicleSpecificationController extends Controller
{
    private const SOURCE_URL = 'https://vpic.nhtsa.dot.gov/api/vehicles/GetCanadianVehicleSpecifications/';

    public function years(Request $request): JsonResponse
    {
        $vehicle = $this->validatedVehicle($request, false);
        $currentYear = now()->addYear()->year;
        $years = collect(range(1971, $currentYear))
            ->reverse()
            ->values();

        try {
            $availableYears = Cache::remember(
                $this->cacheKey('years', $vehicle),
                now()->addDays(90),
                function () use ($vehicle, $years): array {
                $responses = Http::pool(function (Pool $pool) use ($vehicle, $years): array {
                    return $years->mapWithKeys(fn (int $year) => [
                        $year => $pool->as((string) $year)
                            ->acceptJson()
                            ->timeout(12)
                            ->get(self::SOURCE_URL, $this->sourceQuery($vehicle, $year)),
                    ])->all();
                });

                return $years
                    ->filter(fn (int $year) => $this->hasMatchingSpecification($responses[(string) $year] ?? null, $vehicle['model']))
                    ->values()
                    ->all();
                }
            );
        } catch (Throwable) {
            $availableYears = [];
        }

        return response()->json(['years' => $availableYears]);
    }

    public function dimensions(Request $request): JsonResponse
    {
        $vehicle = $this->validatedVehicle($request);

        $specifications = Cache::remember(
            $this->cacheKey('dimensions', $vehicle),
            now()->addDays(90),
            fn (): array => $this->fetchSpecifications($vehicle, $vehicle['year'])
        );

        $specification = collect($specifications)
            ->sortByDesc(fn (array $item) => $this->matchScore($item['model'], $vehicle['model']))
            ->first(fn (array $item) => $this->matchScore($item['model'], $vehicle['model']) > 0);

        return response()->json([
            'dimensions' => $specification ? Arr::only($specification, ['length', 'width', 'height']) : null,
            'source_model' => $specification['model'] ?? null,
        ]);
    }

    private function validatedVehicle(Request $request, bool $requiresYear = true): array
    {
        $rules = [
            'brand' => ['required', 'string', 'max:60'],
            'model' => ['required', 'string', 'max:80'],
            'year' => [$requiresYear ? 'required' : 'nullable', 'integer', 'min:1971', 'max:'.now()->addYear()->year],
        ];

        return $request->validate($rules);
    }

    private function fetchSpecifications(array $vehicle, int $year): array
    {
        try {
            $response = Http::acceptJson()
                ->timeout(12)
                ->retry(1, 200)
                ->get(self::SOURCE_URL, $this->sourceQuery($vehicle, $year));
        } catch (Throwable) {
            return [];
        }

        return $this->parseSpecifications($response, $vehicle['model']);
    }

    private function hasMatchingSpecification(mixed $response, string $model): bool
    {
        if (! $response instanceof \Illuminate\Http\Client\Response) {
            return false;
        }

        return $this->parseSpecifications($response, $model) !== [];
    }

    private function parseSpecifications(\Illuminate\Http\Client\Response $response, string $model): array
    {
        if (! $response->successful()) {
            return [];
        }

        return collect($response->json('Results', []))
            ->map(function (array $result): ?array {
                $specs = collect($result['Specs'] ?? [])
                    ->mapWithKeys(fn (array $specification) => [$specification['Name'] => $specification['Value']]);

                $length = (float) ($specs['OL'] ?? 0);
                $width = (float) ($specs['OW'] ?? 0);
                $height = (float) ($specs['OH'] ?? 0);

                if (! $specs->get('Model') || $length <= 0 || $width <= 0 || $height <= 0) {
                    return null;
                }

                return [
                    'model' => $specs->get('Model'),
                    'length' => round($length / 100, 2),
                    'width' => round($width / 100, 2),
                    'height' => round($height / 100, 2),
                ];
            })
            ->filter(fn (?array $specification) => $specification !== null && $this->matchScore($specification['model'], $model) > 0)
            ->values()
            ->all();
    }

    private function sourceQuery(array $vehicle, int $year): array
    {
        return [
            'year' => $year,
            'make' => $vehicle['brand'],
            'model' => $this->baseModel($vehicle['model']),
            'format' => 'json',
        ];
    }

    private function baseModel(string $model): string
    {
        return preg_replace('/\\s+(?:[A-Z]\\d+|\\d+)$/i', '', $model) ?: $model;
    }

    private function matchScore(string $sourceModel, string $selectedModel): int
    {
        $source = $this->normalise($sourceModel);
        $selected = $this->normalise($this->baseModel($selectedModel));

        if ($source === '' || $selected === '') {
            return 0;
        }

        if ($source === $selected) {
            return 100;
        }

        if (str_contains($source, $selected)) {
            return 50 + strlen($selected);
        }

        return 0;
    }

    private function normalise(string $value): string
    {
        return trim((string) preg_replace('/[^a-z0-9]+/i', ' ', strtolower($value)));
    }

    private function cacheKey(string $type, array $vehicle): string
    {
        return 'vehicle-specifications:'.$type.':'.sha1(implode('|', [
            strtolower($vehicle['brand']),
            strtolower($vehicle['model']),
            $vehicle['year'] ?? '',
        ]));
    }
}
