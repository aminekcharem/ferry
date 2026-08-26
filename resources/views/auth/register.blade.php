<x-layouts.app title="Register">
    <section class="ui-shell flex min-h-[calc(100vh-65px)] items-center justify-center py-10">
        <div class="w-full max-w-md">
            <div class="ui-card p-6">
                <span class="ui-badge">Team account</span>
                <h1 class="mt-4 text-2xl font-bold text-slate-950">Register</h1>
                <p class="mt-2 text-sm text-slate-600">Create access to track and process CTN requests.</p>

                <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="ui-label">Name</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required autofocus class="ui-input">
                        @error('name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="email" class="ui-label">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required class="ui-input">
                        @error('email')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password" class="ui-label">Password</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required class="ui-input">
                        @error('password')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="ui-label">Confirm password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required class="ui-input">
                    </div>

                    <button class="ui-button-primary w-full" type="submit">Create account</button>
                </form>

                <p class="mt-6 text-center text-sm text-slate-600">
                    Already registered?
                    <a href="{{ route('login') }}" class="ui-link">Log in</a>
                </p>
            </div>
        </div>
    </section>
</x-layouts.app>
