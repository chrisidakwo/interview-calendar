<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterviewerStoreRequest;
use App\Repositories\InterviewerRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InterviewerController extends Controller {
    private InterviewerRepository $interviewerRepository;

    public function __construct(InterviewerRepository $interviewerRepository) {
        $this->interviewerRepository = $interviewerRepository;
    }

    public function index(Request $request) {
        $interviewers = $this->interviewerRepository->listInterviewers();

        return $request->expectsJson()
            ? response()->json($interviewers)
            : view('');
    }

    public function store(InterviewerStoreRequest $request) {
        $name         = $request->get('name');
        $email        = $request->get('email');
        $availability = $request->get('availability');

        $interviewer = $this->interviewerRepository->storeInterviewer($name, $email, $availability);

        return $request->expectsJson()
            ? response()->json($interviewer, Response::HTTP_CREATED)
            : redirect()->back()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Request $request) {
    }
}
