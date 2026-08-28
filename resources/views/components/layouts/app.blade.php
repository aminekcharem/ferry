<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? config('app.name', 'Ferry') }}</title>
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.png') }}">
        <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen text-slate-950 antialiased">
        <div class="min-h-screen">
            <header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/90 backdrop-blur">
                <div class="ui-shell flex min-h-16 flex-wrap items-center justify-between gap-3 py-3">
                    <a href="{{ url('/') }}" class="group inline-flex items-center">
                        <img
                            src="{{ asset('images/logo-yesmin-tours.png') }}"
                            alt="Yesmin Tours"
                            class="h-12 w-auto max-w-[11rem] object-contain sm:h-14 sm:max-w-[13rem]"
                        >
                    </a>

                    <nav class="flex flex-wrap items-center justify-end gap-2 text-sm">
                        @auth
                            @php($unreadCtnReservations = \App\Models\CtnReservationMessage::unread()->count())
                            <a class="ui-button-secondary" href="{{ route('dashboard') }}">
                                <x-icon name="home" />
                                <span>Dashboard</span>
                            </a>
                            @if (auth()->user()->isAdmin())
                                <a class="ui-button-secondary" href="{{ route('backoffice.settings.edit') }}">
                                    <x-icon name="settings" />
                                    <span>Settings</span>
                                </a>
                                <a class="ui-button-secondary" href="{{ route('backoffice.users.index') }}">
                                    <x-icon name="users" />
                                    <span>Users</span>
                                </a>
                            @endif
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
                                <span>Ferry Requests</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="ui-button-secondary" type="submit">
                                    <x-icon name="log-out" />
                                    <span>Log out</span>
                                </button>
                            </form>
                        @else
                            <a class="ui-button-secondary" href="{{ route('reservation.ctn') }}">
                                <x-icon name="ship" />
                                <span>Ferry Booking</span>
                            </a>
                            <a class="inline-flex items-center gap-2 px-3 py-2 font-semibold text-slate-700 hover:text-primary-700" href="{{ route('login') }}">
                                <x-icon name="log-in" />
                                <span>Log in</span>
                            </a>
                            @if (\Illuminate\Support\Facades\Schema::hasTable('users') && ! \App\Models\User::query()->exists())
                                <a class="ui-button-primary" href="{{ route('register') }}">
                                    <x-icon name="plus" />
                                    <span>Create first admin</span>
                                </a>
                            @endif
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
