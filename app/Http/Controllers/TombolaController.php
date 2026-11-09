<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpinTombolaRequest;
use App\Http\Requests\TombolaDeviceRequest;
use App\Services\TombolaService;
use Illuminate\Http\JsonResponse;

class TombolaController extends Controller
{
    public function __construct(private readonly TombolaService $tombola) {}

    public function status(TombolaDeviceRequest $request): JsonResponse
    {
        return response()->json($this->tombola->status($request->validated('device_id')))->header('Cache-Control', 'no-store');
    }

    public function spin(SpinTombolaRequest $request): JsonResponse
    {
        return response()->json($this->tombola->spin($request->validated()))->header('Cache-Control', 'no-store');
    }

    public function recover(TombolaDeviceRequest $request): JsonResponse
    {
        $data = $request->validate(['token' => ['required', 'string', 'max:2048'], 'request_id' => ['required', 'uuid']]);

        return response()->json(['previous' => $this->tombola->recover($request->validated('device_id'), $data['token'], $data['request_id'])])->header('Cache-Control', 'no-store');
    }
}
