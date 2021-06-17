<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TimeSlot extends UUIDModel {
    public const DAYS = [
        CarbonInterface::MONDAY    => 'Monday',
        CarbonInterface::TUESDAY   => 'Tuesday',
        CarbonInterface::WEDNESDAY => 'Wednesday',
        CarbonInterface::THURSDAY  => 'Thursday',
        CarbonInterface::FRIDAY    => 'Friday'
    ];

    public const SLOTS = [
        ['start' => '07:00', 'end' => '08:00'], ['start' => '08:00', 'end' => '09:00'],
        ['start' => '09:00', 'end' => '10:00'], ['start' => '10:00', 'end' => '11:00'],
        ['start' => '11:00', 'end' => '12:00'], ['start' => '12:00', 'end' => '13:00'],
        ['start' => '13:00', 'end' => '14:00'], ['start' => '14:00', 'end' => '15:00'],
        ['start' => '15:00', 'end' => '16:00'], ['start' => '16:00', 'end' => '17:00'],
        ['start' => '17:00', 'end' => '18:00'],
    ];

    public function interviewersAvailability() {
    }

    /**
     * @return HasMany
     */
    public function interviews(): HasMany {
        return $this->hasMany(Interview::class);
    }
}
