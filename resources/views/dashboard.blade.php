<x-layouts.app title="Dashboard">
    @php
        $totalReservations = \App\Models\CtnReservationMessage::count();
        $unreadReservations = \App\Models\CtnReservationMessage::unread()->count();
        $latestReservation = \App\Models\CtnReservationMessage::latest()->first();
    @endphp

    <section class="ui-shell backoffice-surface py-8 lg:py-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <span class="ui-badge">Backoffice</span>
                <h1 class="mt-3 text-3xl font-bold text-slate-950">Hello, {{ auth()->user()->name }}</h1>
                <p class="mt-2 text-sm text-slate-600">Quick view of ferry requests and processing access.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('backoffice.users.index') }}" class="ui-button-secondary">
                        <x-icon name="users" />
                        <span>Manage users</span>
                    </a>
                @endif
                <a href="{{ route('backoffice.ctn-reservations.index') }}" class="ui-button-primary">
                    <x-icon name="mail" />
                    <span>Process requests</span>
                </a>
            </div>
        </div>

        <div class="grid gap-5 md:grid-cols-3">
            <div class="ui-card metric-card border-l-primary p-6">
                <p class="flex items-center gap-2 text-sm font-semibold text-slate-500"><x-icon name="mail" /> Total requests</p>
                <p class="mt-3 text-4xl font-bold text-slate-950">{{ $totalReservations }}</p>
            </div>
            <div class="ui-card metric-card border-l-red-500 p-6">
                <p class="flex items-center gap-2 text-sm font-semibold text-slate-500"><x-icon name="eye" /> Unread</p>
                <p class="mt-3 text-4xl font-bold text-red-600">{{ $unreadReservations }}</p>
            </div>
            <div class="ui-card metric-card border-l-emerald-500 p-6">
                <p class="flex items-center gap-2 text-sm font-semibold text-slate-500"><x-icon name="calendar" /> Latest request</p>
                <p class="mt-3 text-lg font-bold text-slate-950">{{ $latestReservation?->created_at?->format('d/m/Y H:i') ?? 'None' }}</p>
            </div>
        </div>

        <div class="mt-6 ui-card backoffice-card p-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-xl font-bold text-slate-950">Processing queue</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-600">Open the list to review contacts, trips, vehicles, and passenger details.</p>
                </div>
                <a href="{{ route('backoffice.ctn-reservations.index') }}" class="ui-button-secondary">
                    <x-icon name="eye" />
                    <span>View list</span>
                </a>
            </div>
        </div>

        @if (auth()->user()->isAdmin())
            <div class="mt-6 ui-card backoffice-card p-6">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-slate-950">Team access</h2>
                        <p class="mt-2 text-sm leading-6 text-slate-600">Create accounts for people who can log in and process reservations.</p>
                    </div>
                    <a href="{{ route('backoffice.users.create') }}" class="ui-button-secondary">
                        <x-icon name="plus" />
                        <span>Add user</span>
                    </a>
                </div>
            </div>
        @endif
    </section>
</x-layouts.app>
