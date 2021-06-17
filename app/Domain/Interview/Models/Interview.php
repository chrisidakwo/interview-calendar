<?php

namespace App\Domain\Interview\Models;

use App\Models\UUIDModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Interview extends UUIDModel {
    /**
     * @return array
     */
    public function getAvailableSlots(): array {
        // TODO: Get availability slots for associated interviewers
    }

    /**
     * @return HasOne
     */
    public function candidate(): HasOne {
        return $this->hasOne(Candidate::class, 'candidate_id');
    }

    /**
     * @return BelongsToMany
     */
    public function interviewers(): BelongsToMany {
        return $this->belongsToMany(Interviewer::class, 'interview_interviewers', 'interviewer_id');
    }
}
