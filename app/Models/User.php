<?php

namespace App\Models;

use App\Collection\InterviewerCollection;
use Database\Factories\UserFactory;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends UUIDModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {
    use Authenticatable, Authorizable, CanResetPassword, HasFactory;

    public const ROLE_ADMIN       = 'admin';
    public const ROLE_CANDIDATE   = 'candidate';
    public const ROLE_INTERVIEWER = 'interviewer';

    protected $fillable = ['name', 'email', 'password', 'role', 'availability'];

    protected $hidden = ['password'];

    protected $casts = [
        'availability' => 'array'
    ];

    /**
     * @return UserFactory
     */
    protected static function newFactory(): UserFactory {
        return UserFactory::new();
    }

    /**
     * @param array $models
     * @return InterviewerCollection
     */
    public function newCollection(array $models = []): InterviewerCollection {
        return new InterviewerCollection($models);
    }

    /**
     * @return HasOne|BelongsToMany
     */
    public function interviews() {
        if ($this->getAttribute('role') === self::ROLE_CANDIDATE) {
            return $this->hasOne(Interview::class, 'candidate_id', 'id');
        }

        return $this->belongsToMany(Interview::class, 'interview_interviewers', 'interviewer_id');
    }
}
