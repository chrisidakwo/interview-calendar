<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Pagination\Paginator;

class UserService implements UserRepository {
    /**
     * @inheritDoc
     */
    public function storeUser(string $name, string $email, string $role, array $availability = []) {
        // Build availability

        return User::query()->create([
            'name'         => $name,
            'email'        => $email,
            'password'     => bcrypt('password'),
            'role'         => $role,
            'availability' => $availability
        ]);
    }

    /**
     * @inheritDoc
     */
    public function listUsers(string $role, array $relations = []): Paginator {
        return User::query()->where('role', $role)
            ->with($relations)->simplePaginate();
    }

    /**
     * @inheritDoc
     */
    public function findUserById(string $userId) {
        return User::query()->find($userId);
    }

    /**
     * @inheritDoc
     */
    public function updateAvailability(string $userId, array $slots): bool {
        $user = $this->findUserById($userId);

        return $user->update([
            'availability' => $slots
        ]);
    }
}
