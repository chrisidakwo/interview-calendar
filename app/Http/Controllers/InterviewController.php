<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterviewStoreRequest;
use App\Http\Requests\StoreInterviewScheduleRequest;
use App\Models\Interview;
use App\Models\User;
use App\Repositories\InterviewRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
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

        $this->middleware(['availability'])->only(['create', 'store']);
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
        $name           = $request->get('name');
        $description    = $request->get('description');
        $candidate      = $request->get('candidate');

        $interview = $this->interviewRepository
            ->storeInterview($name, $candidate, $description);

        session()->flash('success', 'Interview created for ' . $interview->candidate->name);

        return redirect()->route('interviews');
    }

    /**
     * @param Request $request
     * @param Interview $interview
     * @return Application|Factory|View|RedirectResponse
     */
    public function showScheduleForm(Request $request, Interview $interview) {
        $a = User::query()->whereEmail('chris.idakwo@gmail.com')->first()->availability;
        $b = User::query()->whereEmail('daizyodurukwe@gmail.com')->first()->availability;

        $selectedDay = $request->query('day');
        $month       = $request->query('month');

        if (empty($month) || Carbon::create(explode('-', $month)[0], explode('-', $month)[1])->endOfMonth()->isPast()) {
            $month = sprintf('%s-%s', date('Y'), date('m'));

            return redirect()->route('interviews.schedule', ['interview' => $interview->id, 'month' => $month]);
        }

        // Retrieve availability slots for candidate and interviewers
        $interviewersSlots = $interview->interviewers->getAvailableSlots()->toArray()[0];
        $candidateSlots    = $interview->candidate->availability;

        $availableSlots = getAvailableSlots($interviewersSlots, $candidateSlots);

        return view('interviews.schedule', compact('interview', 'month', 'selectedDay', 'availableSlots', 'candidateSlots', 'interviewersSlots'));
    }

    /**
     * @param StoreInterviewScheduleRequest $request
     * @param Interview $interview
     * @return RedirectResponse
     */
    public function schedule(StoreInterviewScheduleRequest $request, Interview $interview): RedirectResponse {
        $timeSlot       = $request->get('time_slot');
        [$year, $month] = explode('-', $request->get('month'));
        $day            = $request->get('day');

        $interviewDate = Carbon::create($year, $month, $day, $timeSlot);

        $this->interviewRepository->updateInterviewSchedule($interview, $interviewDate);

        session()->flash('success', 'Interview scheduled!');

        return redirect()->route('dashboard');
    }
}
