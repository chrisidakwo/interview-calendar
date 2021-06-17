<?php

namespace App\Domain\Interview\Models;

use App\Models\UUIDModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TimeSlot extends UUIDModel {
    public function interviewersAvailability() {
    }

    /**
     * @return HasMany
     */
    public function interviews(): HasMany {
        return $this->hasMany(Interview::class);
    }
}
