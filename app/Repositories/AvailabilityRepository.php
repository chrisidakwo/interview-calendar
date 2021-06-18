<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface AvailabilityRepository {
    /**
     * @param array $slots
     * @param string $userID
     * @return Model|User
     */
    public function storeAvailability(array $slots, string $userID);
}
