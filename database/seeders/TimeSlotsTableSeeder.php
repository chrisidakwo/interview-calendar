<?php

namespace Database\Seeders;

use App\Models\TimeSlot;
use Illuminate\Database\Seeder;

class TimeSlotsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $daysOfTheWeek = array_keys(TimeSlot::DAYS);
        $timeSlots     = TimeSlot::SLOTS;

        foreach ($daysOfTheWeek as $day) {
            // Assign time slot
            foreach ($timeSlots as $timeSlot) {
                TimeSlot::query()->create([
                    'day'        => $day,
                    'start_time' => $timeSlot['start'],
                    'end_time'   => $timeSlot['end']
                ]);
            }
        }
    }
}
