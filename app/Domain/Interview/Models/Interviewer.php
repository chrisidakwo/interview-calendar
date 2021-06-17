<?php

namespace App\Domain\Interview\Models;

use App\Models\UUIDModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Interviewer extends UUIDModel {
    protected $casts = [
        'availability' => 'array'
    ];

    /**
     * @return BelongsToMany
     */
    public function interviews(): BelongsToMany {
        return $this->belongsToMany(Interview::class, 'interview_interviewers', 'interviewer_id');
    }
}
