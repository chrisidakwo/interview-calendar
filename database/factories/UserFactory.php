<?php

namespace Database\Factories;

use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class UserFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array {
        return [
            'name'     => $this->faker->name,
            'email'    => $this->faker->companyEmail,
            'password' => bcrypt('password')
        ];
    }

    /**
     * @param int $count
     * @return array
     */
    public static function generateRandomAvailability(int $count): array {
        $availability = [];

        for ($i = 1; $i <= $count; $i++) {
            $availability[] = [Arr::random(array_keys(TimeSlot::DAYS)) => Arr::random(TimeSlot::SLOTS)];
        }

        return $availability;
    }

    /**
     * Indicate that the user is an interviewer.
     *
     * @return Factory
     */
    public function interviewer(): Factory {
        return $this->state(function (array $attributes) {
            return [
                'role'         => User::ROLE_INTERVIEWER,
                'availability' => self::generateRandomAvailability(20),
            ];
        });
    }

    /**
     * Add user role.
     *
     * @param string $role
     * @return Factory
     */
    public function role(string $role): Factory {
        return $this->state(function (array $attributes) use ($role) {
            return [
                'role' => $role,
            ];
        });
    }

    /**
     * @return Factory
     */
    public function admin(): Factory {
        return $this->state(function (array $attributes) {
            return [
                'name'  => 'Administrator',
                'email' => 'admin@interview.com',
                'role'  => User::ROLE_ADMIN,
            ];
        });
    }

    /**
     * @return Factory
     */
    public function candidate(): Factory {
        return $this->role(User::ROLE_CANDIDATE);
    }
}
