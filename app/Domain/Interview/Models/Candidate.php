<?php

namespace App\Domain\Interview\Models;

use App\Models\UUIDModel;
use Database\Factories\CandidateFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Candidate extends UUIDModel {
    use HasFactory;

    /**
     * @return CandidateFactory
     */
    protected static function newFactory(): CandidateFactory {
        return CandidateFactory::new();
    }

    /**
     * @return BelongsTo
     */
    public function interview(): BelongsTo {
        return $this->belongsTo(Interview::class);
    }
}
