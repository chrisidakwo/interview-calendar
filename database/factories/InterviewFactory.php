<?php

namespace Database\Factories;

use App\Models\Interview;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterviewFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Interview::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Exception
     */
    public function definition(): array {
        $timeslot = TimeSlot::query()->inRandomOrder()->first();

        $year          = date('Y');
        $month         = date('m');
        $startTimeHour = explode(':', $timeslot->start_time)[0];

        return [
            'name'             => $this->faker->jobTitle,
            'description'      => $this->faker->text(300),
            'candidate_id'     => '',
            'time_slot'        => Carbon::create($year, $month, $timeslot->day, $startTimeHour),
            'min_booking_time' => $startTime = Carbon::create($year, $month, $timeslot->day, $startTimeHour),
            'max_booking_time' => $startTime->clone()->addDays(random_int(1, 4))
        ];
    }

    /**
     * Set candidate id.
     *
     * @param string $candidateId
     * @return InterviewFactory
     */
    public function candidate(string $candidateId): InterviewFactory {
        return $this->state(function (array $attributes) use ($candidateId) {
            return [
                'candidate_id' => $candidateId,
            ];
        });
    }
}
