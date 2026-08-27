<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserManagementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(private readonly UserManagementService $users) {}

    public function index(): View
    {
        return view('backoffice.users-index', [
            'users' => User::query()->latest()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('backoffice.users-create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = $this->users->create($request->validated());

        return redirect()
            ->route('backoffice.users.edit', $user)
            ->with('status', 'The user account has been created.');
    }

    public function edit(User $user): View
    {
        return view('backoffice.users-edit', [
            'user' => $user,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $this->users->update($user, $request->validated(), $request->user());

        return redirect()
            ->route('backoffice.users.edit', $user)
            ->with('status', 'The user account has been updated.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        $this->users->delete($user, $request->user());

        return redirect()
            ->route('backoffice.users.index')
            ->with('status', 'The user account has been deleted.');
    }
}
