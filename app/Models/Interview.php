<?php

namespace App\Models;

use Database\Factories\InterviewFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Interview extends UUIDModel {
    use HasFactory;

    protected $guarded = [''];

    /**
     * @return InterviewFactory
     */
    protected static function newFactory(): InterviewFactory {
        return InterviewFactory::new();
    }

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
        return $this->hasOne(User::class, 'id', 'candidate_id');
    }

    /**
     * @return BelongsToMany
     */
    public function interviewers(): BelongsToMany {
        return $this->belongsToMany(User::class, 'interview_interviewers', 'interview_id', 'interviewer_id');
    }

    /**
     * @param string $interviewerId
     * @return array
     */
    public function otherInterviewers(string $interviewerId): array {
        return $this->interviewers()->where('interviewer_id', '!=', $interviewerId)->pluck('users.name')
            ->toArray();
    }
}
