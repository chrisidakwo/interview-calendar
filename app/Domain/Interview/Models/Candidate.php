<?php

namespace App\Domain\Interview\Models;

use App\Models\UUIDModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Candidate extends UUIDModel {
    /**
     * @return BelongsTo
     */
    public function interview(): BelongsTo {
        return $this->belongsTo(Interview::class);
    }
}
