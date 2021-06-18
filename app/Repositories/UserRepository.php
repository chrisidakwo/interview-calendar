<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;

interface UserRepository {
    /**
     * Return a list of interviewers.
     *
     * @param string $role
     * @param array $relations
     * @return Paginator
     */
    public function listUsers(string $role, array $relations = []): Paginator;

    /**
     * Create a new interviewer.
     *
     * @param string $name
     * @param string $email
     * @param string $role
     * @param array $availability
     * @return Model|User
     */
    public function storeUser(string $name, string $email, string $role, array $availability = []);

    /**
     * @param string $userId
     * @return Model|User
     */
    public function findUserById(string $userId);

    /**
     * @param string $userId
     * @param array $slots
     * @return bool
     */
    public function updateAvailability(string $userId, array $slots): bool;
}
