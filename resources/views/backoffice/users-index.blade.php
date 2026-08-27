<x-layouts.app title="Users">
    <section class="ui-shell backoffice-surface py-8 lg:py-10">
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <span class="ui-badge"><x-icon name="users" /> Administration</span>
                <h1 class="mt-3 text-3xl font-bold text-slate-950">Users</h1>
                <p class="mt-2 text-sm text-slate-600">Manage who can log in and process ferry reservations.</p>
            </div>
            <a href="{{ route('backoffice.users.create') }}" class="ui-button-primary">
                <x-icon name="plus" />
                <span>Add user</span>
            </a>
        </div>

        @if (session('status'))
            <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->has('user'))
            <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                {{ $errors->first('user') }}
            </div>
        @endif

        <div class="ui-card backoffice-card overflow-hidden">
            @if ($users->isEmpty())
                <div class="p-10 text-center">
                    <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-md bg-slate-100 text-xl font-bold text-slate-500">0</span>
                    <h2 class="mt-4 text-lg font-bold text-slate-950">No users</h2>
                    <p class="mt-2 text-sm text-slate-600">Created accounts will appear here.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead class="bg-slate-50 text-left text-xs font-bold uppercase text-slate-500">
                            <tr>
                                <th class="px-5 py-4">User</th>
                                <th class="px-5 py-4">Email</th>
                                <th class="px-5 py-4">Role</th>
                                <th class="px-5 py-4">Created</th>
                                <th class="px-5 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @foreach ($users as $user)
                                <tr class="align-top transition hover:bg-primary-50/40">
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3">
                                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-slate-100 text-xs font-bold text-slate-600">
                                                {{ strtoupper(mb_substr($user->name, 0, 2)) }}
                                            </span>
                                            <div>
                                                <p class="font-bold text-slate-950">{{ $user->name }}</p>
                                                @if ($user->is(auth()->user()))
                                                    <p class="mt-1 text-xs font-semibold text-primary-700">Current account</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 text-slate-700">{{ $user->email }}</td>
                                    <td class="px-5 py-4">
                                        <span class="inline-flex rounded-full border px-2.5 py-1 text-xs font-bold {{ $user->is_admin ? 'border-primary-200 bg-primary-50 text-primary-800' : 'border-slate-200 bg-slate-50 text-slate-700' }}">
                                            {{ $user->is_admin ? 'Administrator' : 'Reservation agent' }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-slate-700">{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td class="px-5 py-4">
                                        <div class="flex flex-wrap justify-end gap-2">
                                            <a href="{{ route('backoffice.users.edit', $user) }}" class="ui-button-secondary">
                                                <x-icon name="pencil" />
                                                <span>Edit</span>
                                            </a>
                                            @unless ($user->is(auth()->user()))
                                                <form method="POST" action="{{ route('backoffice.users.destroy', $user) }}" onsubmit="return confirm('Delete this user account?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="ui-button-secondary text-red-700 hover:border-red-300 hover:bg-red-50">
                                                        <x-icon name="trash" />
                                                        <span>Delete</span>
                                                    </button>
                                                </form>
                                            @endunless
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </section>
</x-layouts.app>
