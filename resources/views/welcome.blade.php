<x-layouts.app title="Ferry Reservations">
    <section class="border-b border-slate-200 bg-white">
        <div class="ui-shell grid min-h-[calc(100vh-65px)] items-center gap-10 py-12 lg:grid-cols-[1fr_430px] lg:py-16">
            <div class="max-w-3xl">
                <span class="ui-badge">Ferry booking</span>
                <h1 class="mt-5 text-4xl font-bold leading-tight text-slate-950 sm:text-5xl lg:text-6xl">
                    Book your crossing with vehicle, passengers, and trailer in minutes.
                </h1>
                <p class="mt-5 max-w-2xl text-lg leading-8 text-slate-600">
                    A clear journey for customers and an organized backoffice to process every ferry request without losing important information.
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('reservation.ctn') }}" class="ui-button-primary px-6">
                        <x-icon name="ship" />
                        <span>Start a reservation</span>
                    </a>
                    <a href="{{ route('login') }}" class="ui-button-secondary px-6">
                        <x-icon name="log-in" />
                        <span>Access backoffice</span>
                    </a>
                </div>
                <div class="mt-10 grid gap-4 sm:grid-cols-3">
                    <div class="border-l-2 border-primary pl-4">
                        <p class="text-2xl font-bold text-slate-950">3</p>
                        <p class="text-sm text-slate-600">departure countries</p>
                    </div>
                    <div class="border-l-2 border-primary pl-4">
                        <p class="text-2xl font-bold text-slate-950">24/7</p>
                        <p class="text-sm text-slate-600">form available</p>
                    </div>
                    <div class="border-l-2 border-primary pl-4">
                        <p class="text-2xl font-bold text-slate-950">1</p>
                        <p class="text-sm text-slate-600">centralized file</p>
                    </div>
                </div>
            </div>

            <aside class="ui-card overflow-hidden">
                <div class="bg-primary-900 p-6 text-white">
                    <p class="text-sm font-semibold text-primary-100">Ferry request</p>
                    <h2 class="mt-2 text-2xl font-bold">Reservation flow</h2>
                    <p class="mt-3 text-sm leading-6 text-primary-50">The customer enters the itinerary, passengers, vehicle, and sensitive dimensions before validation.</p>
                </div>
                <div class="divide-y divide-slate-200 bg-white">
                    @foreach ([
                        ['Itinerary', 'One-way or round-trip, country, and dates.'],
                        ['Passengers', 'Counters by category and individual details.'],
                        ['Vehicle', 'Brand, model, owner, dimensions, and trailer.'],
                    ] as [$title, $copy])
                        <div class="flex gap-4 p-5">
                            <span class="ui-step">{{ $loop->iteration }}</span>
                            <div>
                                <h3 class="font-semibold text-slate-950">{{ $title }}</h3>
                                <p class="mt-1 text-sm leading-6 text-slate-600">{{ $copy }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </aside>
        </div>
    </section>

    <section class="py-12">
        <div class="ui-shell">
            <div class="grid gap-5 md:grid-cols-3">
                <div class="ui-card p-6">
                    <h2 class="text-lg font-bold text-slate-950">Less friction</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-600">Fields are grouped by intent, and important choices stay visible at the right time.</p>
                </div>
                <div class="ui-card p-6">
                    <h2 class="text-lg font-bold text-slate-950">Backoffice control</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-600">New requests are flagged, sorted, and reviewed in a clean detail view.</p>
                </div>
                <div class="ui-card p-6">
                    <h2 class="text-lg font-bold text-slate-950">Actionable data</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-600">Contact, trip, passengers, vehicle, and trailer data stay separate to make processing easier.</p>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
