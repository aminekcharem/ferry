<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TombolaHistoryRequest;
use App\Http\Requests\UpdateTombolaRequest;
use App\Services\TombolaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TombolaController extends Controller
{
    public function __construct(private readonly TombolaService $tombola) {}

    public function index(TombolaHistoryRequest $request): View
    {
        return view('backoffice.tombola', $this->tombola->history($request->validated()));
    }

    public function update(UpdateTombolaRequest $request): RedirectResponse
    {
        $this->tombola->update($request->campaignData());

        return to_route('backoffice.tombola.index')->with('status', 'La configuration de la tombola a été enregistrée.');
    }

    public function reset(Request $request): RedirectResponse
    {
        $request->validate(['confirmation' => ['required', 'accepted']]);
        $this->tombola->reset($request->user());

        return to_route('backoffice.tombola.index')->with('status', 'Les délais ont été réinitialisés. L’historique et le cycle sont conservés.');
    }
}
