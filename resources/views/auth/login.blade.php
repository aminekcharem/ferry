<x-layouts.app title="Login">
    <section class="ui-shell flex min-h-[calc(100vh-65px)] items-center justify-center py-10">
        <div class="w-full max-w-md">
            <div class="ui-card p-6">
                <span class="ui-badge">Backoffice</span>
                <h1 class="mt-4 text-2xl font-bold text-slate-950">Login</h1>
                <p class="mt-2 text-sm text-slate-600">Access your secure CTN processing workspace.</p>

                @if (session('status'))
                    <div class="mt-5 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="ui-label">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus class="ui-input">
                        @error('email')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password" class="ui-label">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="ui-input">
                        @error('password')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <label class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                        <input type="checkbox" name="remember" value="1" class="rounded border-slate-300 text-primary focus:ring-primary-200">
                        Remember me
                    </label>

                    <button class="ui-button-primary w-full" type="submit">Log in</button>
                </form>

                <p class="mt-6 text-center text-sm text-slate-600">
                    Do not have an account yet?
                    <a href="{{ route('register') }}" class="ui-link">Create an account</a>
                </p>
            </div>
        </div>
    </section>
</x-layouts.app>
