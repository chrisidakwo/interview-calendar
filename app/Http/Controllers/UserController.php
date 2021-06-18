<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller {
    private UserRepository $interviewerRepository;

    public function __construct(UserRepository $interviewerRepository) {
        $this->interviewerRepository = $interviewerRepository;
    }

    public function index(Request $request) {
        $interviewers = $this->interviewerRepository->listUsers();

        return $request->expectsJson()
            ? response()->json($interviewers)
            : view('');
    }

    public function create() {
        return view('interviewers.create');
    }

    /**
     * @param UserStoreRequest $request
     * @return JsonResponse|RedirectResponse|object
     */
    public function store(UserStoreRequest $request) {
        $name         = $request->get('name');
        $email        = $request->get('email');
        $role         = $request->get('role');
        $availability = $request->get('availability');

        $interviewer = $this->interviewerRepository->storeUser($name, $email, $role, $availability);

        return $request->expectsJson()
            ? response()->json($interviewer, Response::HTTP_CREATED)
            : redirect()->back()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Request $request) {
    }
}
