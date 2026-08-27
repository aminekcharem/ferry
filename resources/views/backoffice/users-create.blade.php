<x-layouts.app title="Add user">
    <section class="ui-shell backoffice-surface py-8 lg:py-10">
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <span class="ui-badge"><x-icon name="users" /> Administration</span>
                <h1 class="mt-3 text-3xl font-bold text-slate-950">Add user</h1>
                <p class="mt-2 text-sm text-slate-600">Create an account for someone who needs access to reservations.</p>
            </div>
            <a href="{{ route('backoffice.users.index') }}" class="ui-button-secondary">
                <x-icon name="chevron-left" />
                <span>Back to users</span>
            </a>
        </div>

        <div class="ui-card backoffice-card p-6">
            <form method="POST" action="{{ route('backoffice.users.store') }}" class="grid gap-5 lg:grid-cols-2">
                @csrf

                <div>
                    <label for="name" class="ui-label">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required class="ui-input">
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

                <label class="flex items-start gap-3 rounded-md border border-slate-200 bg-slate-50 p-4 text-sm font-semibold text-slate-800 lg:col-span-2">
                    <input type="checkbox" name="is_admin" value="1" @checked(old('is_admin')) class="mt-1 rounded border-slate-300 text-primary focus:ring-primary-200">
                    <span>
                        Administrator
                        <span class="mt-1 block text-sm font-normal text-slate-600">Administrators can create, edit, and delete user accounts.</span>
                    </span>
                </label>
                @error('is_admin')<p class="text-sm text-red-600 lg:col-span-2">{{ $message }}</p>@enderror

                <div class="flex flex-wrap gap-2 lg:col-span-2">
                    <button type="submit" class="ui-button-primary">
                        <x-icon name="plus" />
                        <span>Create account</span>
                    </button>
                    <a href="{{ route('backoffice.users.index') }}" class="ui-button-secondary">
                        <x-icon name="x" />
                        <span>Cancel</span>
                    </a>
                </div>
            </form>
        </div>
    </section>
</x-layouts.app>
