<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterviewStoreRequest;
use App\Models\User;
use App\Repositories\InterviewRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InterviewController extends Controller {
    private UserRepository $userRepository;

    private InterviewRepository $interviewRepository;

    public function __construct(InterviewRepository $interviewRepository, UserRepository $userRepository) {
        $this->userRepository      = $userRepository;
        $this->interviewRepository = $interviewRepository;
    }

    public function index(Request $request) {
        $interviews = $this->interviewRepository->listInterviews(['interviewers']);

        return view('interviews.index', compact('interviews'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create() {
        $candidates = $this->userRepository->listUsers(User::ROLE_CANDIDATE);

        return view('interviews.create', compact('candidates'));
    }

    /**
     * @param InterviewStoreRequest $request
     * @return RedirectResponse
     */
    public function store(InterviewStoreRequest $request): RedirectResponse {
        $name        = $request->get('name');
        $description = $request->get('description');
        $candidate   = $request->get('candidate');

        $interview = $this->interviewRepository->storeInterview($name, $description, $candidate);

        session()->flash('success', 'Interview created for ' . $interview->candidate->name);

        return redirect()->route('interviews');
    }
}
