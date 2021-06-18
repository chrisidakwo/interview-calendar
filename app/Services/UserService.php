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
    public function listUsers(array $filter = [], int $page = null, int $perPage = 25, $columns = ['*']): Paginator {
        return User::query()->simplePaginate($perPage, $columns, 'page', $page);
    }
}
