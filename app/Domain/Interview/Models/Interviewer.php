<?php

namespace App\Domain\Interview\Models;

use App\Models\UUIDModel;
use Database\Factories\InterviewerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Interviewer extends UUIDModel {
    use HasFactory;

    protected $casts = [
        'availability' => 'array'
    ];

    /**
     * @return InterviewerFactory
     */
    protected static function newFactory(): InterviewerFactory {
        return InterviewerFactory::new();
    }

    /**
     * @return BelongsToMany
     */
    public function interviews(): BelongsToMany {
        return $this->belongsToMany(Interview::class, 'interview_interviewers', 'interviewer_id');
    }
}
