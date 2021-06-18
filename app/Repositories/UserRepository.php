<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;

interface UserRepository {
    /**
     * Return a list of interviewers.
     *
     * @param array $filter
     * @param int|null $page
     * @param int $perPage
     * @param string[] $columns
     * @return Paginator
     */
    public function listUsers(array $filter = [], int $page = null, int $perPage = 25, $columns = ['*']): Paginator;

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
}
