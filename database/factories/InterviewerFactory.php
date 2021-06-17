<?php

namespace Database\Factories;

use App\Models\Interviewer;
use App\Models\TimeSlot;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class InterviewerFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Interviewer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array {
        return [
            'name'         => $this->faker->name,
            'email'        => $this->faker->companyEmail,
            'availability' => self::generateRandomAvailability(20)
        ];
    }

    /**
     * @param int $count
     * @return array
     */
    public static function generateRandomAvailability(int $count): array {
        $availability = [];

        for ($i = 1; $i <= $count; $i++) {
            $availability[] = [Arr::random(TimeSlot::DAYS) => Arr::random(TimeSlot::SLOTS)];
        }

        return $availability;
    }
}
