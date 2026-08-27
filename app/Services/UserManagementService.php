<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UserManagementService
{
    /**
     * @param  array{name: string, email: string, password: string, is_admin?: bool}  $data
     */
    public function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'is_admin' => (bool) ($data['is_admin'] ?? false),
        ]);
    }

    /**
     * @param  array{name: string, email: string, password?: string|null, is_admin?: bool}  $data
     */
    public function update(User $user, array $data, User $actor): User
    {
        $isAdmin = (bool) ($data['is_admin'] ?? false);

        if ($user->is($actor) && ! $isAdmin) {
            throw ValidationException::withMessages([
                'is_admin' => 'You cannot remove your own administrator access.',
            ]);
        }

        if ($user->isAdmin() && ! $isAdmin && $this->adminCount() <= 1) {
            throw ValidationException::withMessages([
                'is_admin' => 'At least one administrator account is required.',
            ]);
        }

        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'is_admin' => $isAdmin,
        ]);

        if (! empty($data['password'])) {
            $user->password = $data['password'];
        }

        $user->save();

        return $user;
    }

    public function delete(User $user, User $actor): void
    {
        if ($user->is($actor)) {
            throw ValidationException::withMessages([
                'user' => 'You cannot delete your own account.',
            ]);
        }

        if ($user->isAdmin() && $this->adminCount() <= 1) {
            throw ValidationException::withMessages([
                'user' => 'At least one administrator account is required.',
            ]);
        }

        DB::transaction(fn () => $user->delete());
    }

    private function adminCount(): int
    {
        return User::where('is_admin', true)->count();
    }
}
