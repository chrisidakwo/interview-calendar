<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return bool
     */
    public function isAdmin(): bool {
        return request()->user()->role === User::ROLE_ADMIN;
    }

    /**
     * @return bool
     */
    public function isInterviewer(): bool {
        return request()->user()->role === User::ROLE_INTERVIEWER;
    }

    /**
     * @return bool
     */
    public function isCandidate(): bool {
        return request()->user()->role === User::ROLE_CANDIDATE;
    }
}
