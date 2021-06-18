<?php

namespace App\Services;

use App\Repositories\AvailabilityRepository;
use App\Repositories\UserRepository;

class AvailabilityService implements AvailabilityRepository {
    /**
     * @inheritDoc
     */
    public function storeAvailability(array $slots, string $userID) {
        $userRepository = app(UserRepository::class);

        $userRepository->updateAvailability($userID, $slots);

        return $userRepository->findUserById($userID);
    }
}
