<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller {
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @param string|null $type
     * @return Application|Factory|View|JsonResponse
     */
    public function index(Request $request, $type = null) {
        if (empty($type)) {
            $type = ($request->user()->role === User::ROLE_ADMIN) ? 'interviewer' : 'candidate';
        }

        $users = $this->userRepository->listUsers($type);

        $authRole = $request->user()->role;
        if ($authRole == User::ROLE_ADMIN) {
            return view('dashboard', compact('users'));
        }

        return view('candidates.index', compact('users'));
    }

    public function create(Request $request) {
        if ($this->isAdmin()) {
            return view('interviewers.create');
        }

        return view('candidates.create');
    }

    /**
     * @param UserStoreRequest $request
     * @return RedirectResponse|object
     */
    public function store(UserStoreRequest $request) {
        $name         = $request->get('name');
        $email        = $request->get('email');
        $role         = $request->get('role');
        $availability = $request->get('availability', []);

        $interviewer = $this->userRepository->storeUser($name, $email, $role, $availability);

        $authRole = $request->user()->role;
        if ($authRole == User::ROLE_ADMIN) {
            session()->flash('success', 'Interviewer created');

            return redirect()->route('dashboard')->setStatusCode(Response::HTTP_CREATED);
        }

        session()->flash('success', 'Candidate created');

        return redirect()->route('candidates')->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Request $request) {
    }
}
