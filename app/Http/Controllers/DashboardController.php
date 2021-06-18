<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\InterviewRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    private UserRepository $userRepository;
    /**
     * @var InterviewRepository
     */
    private InterviewRepository $interviewRepository;

    public function __construct(UserRepository $userRepository, InterviewRepository $interviewRepository) {
        $this->userRepository      = $userRepository;
        $this->interviewRepository = $interviewRepository;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request) {
        if ($request->user()->role == User::ROLE_ADMIN) {
            $users = $this->userRepository->listUsers(User::ROLE_INTERVIEWER);
        }

        if ($request->user()->role === User::ROLE_INTERVIEWER) {
            $upcomingInterviews = $this->interviewRepository->listUpcomingInterviews();
            $pastInterviews     = $this->interviewRepository->listPastInterviewers();
        }

        return view('dashboard', [
            'users'              => $users ?? [],
            'upcomingInterviews' => $upcomingInterviews ?? [],
            'pastInterviews'     => $pastInterviews ?? []
        ]);
    }
}
