<?php

namespace Database\Seeders;

use App\Domain\Interview\Models\TimeSlot;
use Illuminate\Database\Seeder;

class TimeSlotsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $daysOfTheWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $timeSlots     = [
            ['start' => '07:00', 'end' => '08:00'],
            ['start' => '08:00', 'end' => '09:00'],
            ['start' => '09:00', 'end' => '10:00'],
            ['start' => '10:00', 'end' => '11:00'],
            ['start' => '11:00', 'end' => '12:00'],
            ['start' => '12:00', 'end' => '13:00'],
            ['start' => '13:00', 'end' => '14:00'],
            ['start' => '14:00', 'end' => '15:00'],
            ['start' => '15:00', 'end' => '16:00'],
            ['start' => '16:00', 'end' => '17:00'],
            ['start' => '17:00', 'end' => '18:00'],
        ];

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
