<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? config('app.name', 'Ferry') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen text-slate-950 antialiased">
        <div class="min-h-screen">
            <header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/90 backdrop-blur">
                <div class="ui-shell flex min-h-16 flex-wrap items-center justify-between gap-3 py-3">
                    <a href="{{ url('/') }}" class="group inline-flex items-center gap-3">
                        <span class="flex h-10 w-10 items-center justify-center rounded-md bg-primary-700 text-sm font-black text-white">CTN</span>
                        <span>
                            <span class="block text-base font-bold leading-5 text-slate-950">FerryDesk</span>
                            <span class="block text-xs font-medium text-slate-500">Maritime reservations</span>
                        </span>
                    </a>

                    <nav class="flex flex-wrap items-center justify-end gap-2 text-sm">
                        @auth
                            @php($unreadCtnReservations = \App\Models\CtnReservationMessage::unread()->count())
                            <a class="ui-button-secondary" href="{{ route('dashboard') }}">Dashboard</a>
                            <a class="relative inline-flex min-h-10 items-center gap-2 rounded-md border border-slate-300 bg-white px-3 py-2 font-semibold text-slate-800 transition hover:border-primary-600 hover:text-primary-700" href="{{ route('backoffice.ctn-reservations.index') }}">
                                <span class="relative inline-flex" aria-hidden="true">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M15 17h5l-1.4-1.4A2 2 0 0 1 18 14.2V11a6 6 0 1 0-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0a3 3 0 0 1-6 0m6 0H9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    @if ($unreadCtnReservations > 0)
                                        <span class="absolute -right-2 -top-2 flex h-5 min-w-5 items-center justify-center rounded-full bg-red-600 px-1 text-[11px] font-bold leading-none text-white">
                                            {{ $unreadCtnReservations > 9 ? '9+' : $unreadCtnReservations }}
                                        </span>
                                    @endif
                                </span>
                                <span>CTN Requests</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="ui-button-secondary" type="submit">
                                    Log out
                                </button>
                            </form>
                        @else
                            <a class="ui-button-secondary" href="{{ route('reservation.ctn') }}">CTN Reservation</a>
                            <a class="px-3 py-2 font-semibold text-slate-700 hover:text-primary-700" href="{{ route('login') }}">Log in</a>
                            <a class="ui-button-primary" href="{{ route('register') }}">Register</a>
                        @endauth
                    </nav>
                </div>
            </header>

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
