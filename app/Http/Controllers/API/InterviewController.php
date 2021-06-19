<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\TimeSlot;
use App\Repositories\InterviewRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InterviewController extends Controller {
    private InterviewRepository $interviewRepository;

    public function __construct(InterviewRepository $interviewRepository) {
        $this->interviewRepository = $interviewRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        $interviews = $this->interviewRepository->listInterviews(['candidate', 'interviewers']);

        return response()->json($interviews);
    }

    /**
     * @param Request $request
     * @param Interview $interview
     * @return JsonResponse
     */
    public function show(Request $request, Interview $interview): JsonResponse {
        return response()->json($interview->load(['candidate', 'interviewers']));
    }

    /**
     * @param Request $request
     * @param Interview $interview
     * @return JsonResponse
     */
    public function availableSlots(Request $request, Interview $interview): JsonResponse {
        $availableSlots = $this->interviewRepository->getAvailableSlots($interview);

        $slots = [];
        foreach ($availableSlots as $dayNumber => $availableSlot) {
            $day         = TimeSlot::DAYS[$dayNumber];
            $slots[$day] = $availableSlot;
        }

        return response()->json($slots);
    }
}
