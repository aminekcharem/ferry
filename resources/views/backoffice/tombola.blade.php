<x-layouts.app title="Popup / Tombola">
    @php($campaignState = $campaign->state())
    <section class="ui-shell backoffice-surface py-8 lg:py-10">
        <div class="mb-7 flex flex-wrap items-end justify-between gap-4">
            <div>
                <span class="ui-badge"><x-icon name="gift" /> Popup / Tombola</span>
                <h1 class="mt-3 text-3xl font-bold text-slate-950">Roue de la chance</h1>
                <p class="mt-2 text-sm leading-6 text-slate-600">Planification et historique — heure allemande (Europe/Berlin).</p>
            </div>
            <a href="{{ route('dashboard') }}" class="ui-button-secondary">Dashboard</a>
        </div>
        @if (session('status'))
            <p role="status" class="mb-5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium leading-6 text-emerald-800">{{ session('status') }}</p>
        @endif
        @if ($errors->any())
            <div role="alert" class="mb-5 rounded-lg border border-red-200 bg-red-50 p-4 text-sm leading-6 text-red-800"><ul class="list-inside list-disc">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif
        <div class="mb-6 grid gap-5 lg:grid-cols-2">
            <div class="ui-card p-5 sm:p-6">
                <div class="flex flex-wrap items-start justify-between gap-3">
                    <div>
                        <h2 class="text-xl font-bold text-slate-950">Configuration</h2>
                        <p class="mt-1 text-sm text-slate-600">Définissez la période de participation.</p>
                    </div>
                    <span class="inline-flex items-center gap-2 rounded-full border px-3 py-1 text-xs font-bold {{ $campaignState === 'active' ? 'border-emerald-200 bg-emerald-50 text-emerald-800' : ($campaignState === 'scheduled' ? 'border-amber-200 bg-amber-50 text-amber-800' : 'border-slate-200 bg-slate-100 text-slate-700') }}">
                        <span class="h-2 w-2 rounded-full {{ $campaignState === 'active' ? 'bg-emerald-500' : ($campaignState === 'scheduled' ? 'bg-amber-500' : 'bg-slate-400') }}" aria-hidden="true"></span>
                        {{ ['disabled' => 'Désactivée', 'scheduled' => 'Programmée', 'active' => 'En cours', 'ended' => 'Terminée'][$campaignState] }}
                    </span>
                </div>
                <form method="POST" action="{{ route('backoffice.tombola.update') }}" class="mt-5 grid gap-4">
                    @csrf @method('PATCH')
                    <input type="hidden" name="enabled" value="0">
                    <label class="flex min-h-12 cursor-pointer items-center gap-3 rounded-lg border border-slate-200 bg-slate-50 px-4 font-semibold text-slate-800">
                        <input class="h-4 w-4 rounded border-slate-300 text-primary focus:ring-primary-200" type="checkbox" name="enabled" value="1" @checked(old('enabled', $campaign->enabled))>
                        Activer la popup
                    </label>
                    <div><label class="ui-label" for="starts_at">Début — Europe/Berlin</label><input class="ui-input" type="datetime-local" id="starts_at" name="starts_at" value="{{ old('starts_at', $campaign->starts_at?->setTimezone('Europe/Berlin')->format('Y-m-d\TH:i')) }}"></div>
                    <div><label class="ui-label" for="ends_at">Fin — Europe/Berlin</label><input class="ui-input" type="datetime-local" id="ends_at" name="ends_at" value="{{ old('ends_at', $campaign->ends_at?->setTimezone('Europe/Berlin')->format('Y-m-d\TH:i')) }}"></div>
                    <p class="rounded-lg bg-slate-50 px-4 py-3 text-sm leading-6 text-slate-600">Début inclus, fin exclue. Changement d’heure automatique ; lors de l’heure répétée en automne, la seconde occurrence est utilisée.</p>
                    <button class="ui-button-primary justify-self-start" type="submit">Enregistrer</button>
                </form>
            </div>
            <div class="ui-card p-5 sm:p-6">
                <h2 class="text-xl font-bold text-slate-950">Participations et tests</h2>
                <p class="mt-1 text-sm text-slate-600">Vue d’ensemble des résultats enregistrés.</p>
                <dl class="mt-5 grid gap-3 sm:grid-cols-3">
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-4"><dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Participations</dt><dd class="mt-2 text-3xl font-bold tabular-nums text-slate-950">{{ $counts->total }}</dd></div>
                    <div class="rounded-lg border border-primary-100 bg-primary-50/70 p-4"><dt class="text-xs font-semibold uppercase tracking-wide text-primary-800">Gains 20 %</dt><dd class="mt-2 text-3xl font-bold tabular-nums text-primary-900">{{ $counts->winners20 }}</dd></div>
                    <div class="rounded-lg border border-primary-200 bg-primary-100/60 p-4"><dt class="text-xs font-semibold uppercase tracking-wide text-primary-900">Gains 30 %</dt><dd class="mt-2 text-3xl font-bold tabular-nums text-primary-900">{{ $counts->winners30 }}</dd></div>
                </dl>
                <p class="mt-5 rounded-lg border border-slate-200 px-4 py-3 text-sm leading-6 text-slate-600">Cycle global : 10 pertes → 20 % → 10 pertes → 30 %. Position actuelle : <strong class="text-slate-900">{{ $campaign->spin_count % 22 }}/22</strong>.</p>
                <form method="POST" action="{{ route('backoffice.tombola.reset') }}" class="mt-5 grid gap-4 rounded-lg border border-amber-200 bg-amber-50/70 p-4" data-tombola-reset>
                    @csrf
                    <label class="flex cursor-pointer items-start gap-3 text-sm leading-6 text-slate-700"><input class="mt-1 h-4 w-4 shrink-0 rounded border-slate-300 text-primary focus:ring-primary-200" type="checkbox" name="confirmation" value="1" required> J’autorise tous les visiteurs à rejouer immédiatement. L’historique et le cycle des gains seront conservés.</label>
                    <button type="submit" class="ui-button-secondary justify-self-start">Réinitialiser les délais de participation</button>
                </form>
                @if ($lastReset)<p class="mt-4 text-sm leading-6 text-slate-600">Dernière réinitialisation : {{ $lastReset->created_at->setTimezone('Europe/Berlin')->format('d/m/Y H:i T') }} — {{ $lastReset->user?->name ?? 'Compte supprimé' }}</p>@endif
                <p class="mt-4 text-sm text-slate-600">Les emails gagnants sont envoyés par la file Laravel. États : en attente, envoyé, nouvelle tentative ou échec.</p>
            </div>
        </div>
        <div class="ui-card p-5 sm:p-6">
            <div>
                <h2 class="text-xl font-bold text-slate-950">Historique des participations</h2>
                <p class="mt-1 text-sm text-slate-600">Recherchez et filtrez les entrées enregistrées.</p>
            </div>
            <form method="GET" class="my-5 grid items-end gap-3 sm:grid-cols-2 lg:grid-cols-5">
                <div><label class="ui-label" for="search">Coordonnées</label><input class="ui-input" type="search" id="search" name="search" value="{{ $filters['search'] ?? '' }}"></div>
                <div><label class="ui-label" for="result">Résultat</label><select class="ui-input" id="result" name="result"><option value="">Tous</option>@foreach ([0 => 'Perdu', 20 => '20 %', 30 => '30 %'] as $value => $label)<option value="{{ $value }}" @selected((string) ($filters['result'] ?? '') === (string) $value)>{{ $label }}</option>@endforeach</select></div>
                <div><label class="ui-label" for="date_from">Du</label><input class="ui-input" type="date" id="date_from" name="date_from" value="{{ $filters['date_from'] ?? '' }}"></div>
                <div><label class="ui-label" for="date_to">Au</label><input class="ui-input" type="date" id="date_to" name="date_to" value="{{ $filters['date_to'] ?? '' }}"></div>
                <div class="flex flex-wrap gap-2"><button class="ui-button-primary">Filtrer</button><a class="ui-link" href="{{ route('backoffice.tombola.index') }}">Effacer</a></div>
            </form>
            <div class="overflow-x-auto rounded-lg border border-slate-200">
                <table class="w-full min-w-[900px] text-left text-sm">
                    <thead class="border-b border-slate-200 bg-slate-50 text-xs uppercase tracking-wide text-slate-600"><tr><th scope="col" class="p-3">Date (Berlin)</th><th scope="col" class="p-3">Participant</th><th scope="col" class="p-3">Email</th><th scope="col" class="p-3">Téléphone</th><th scope="col" class="p-3">Résultat</th><th scope="col" class="p-3">Email gagnant</th></tr></thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($participations as $participation)
                            <tr><td class="whitespace-nowrap p-3">{{ $participation->created_at->setTimezone('Europe/Berlin')->format('d/m/Y H:i T') }}</td><td class="p-3">{{ $participation->first_name }} {{ $participation->last_name }}</td><td class="break-all p-3">{{ $participation->email }}</td><td class="p-3">{{ $participation->phone }}</td><td class="whitespace-nowrap p-3 font-bold">{{ $participation->result ? $participation->result.' %' : 'Perdu' }}</td><td class="p-3">{{ ['not_required' => 'Sans objet', 'pending' => 'En attente', 'retrying' => 'Nouvelle tentative', 'sent' => 'Envoyé', 'failed' => 'Échec'][$participation->email_status] }}</td></tr>
                        @empty
                            <tr><td colspan="6" class="p-8 text-center text-slate-500">Aucune participation pour ces critères.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-5">{{ $participations->links() }}</div>
        </div>
    </section>
</x-layouts.app>
