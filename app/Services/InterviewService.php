<?php

namespace App\Services;

use App\Models\Interview;
use App\Repositories\InterviewRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class InterviewService implements InterviewRepository {
    /**
     * @inheritDoc
     */
    public function listInterviews(array $relations = [], array $filters = []): Paginator {
        return Interview::query()
            ->when(!empty($filters), function ($query) use ($filters) {
                return $query->where($filters);
            })
            ->with($relations)->simplePaginate();
    }

    /**
     * @inheritDoc
     */
    public function storeInterview(string $name, string $candidate, string $description = null, $minBookingDate = null, $maxBookingDate = null) {
        /** @var Interview $interview */
        $interview = Interview::query()->create([
            'id'               => Uuid::uuid4()->toString(),
            'name'             => $name,
            'description'      => $description,
            'candidate_id'     => $candidate,
            'min_booking_time' => $minBookingDate ?: now()->addDay(),
            'max_booking_time' => $maxBookingDate
        ]);

        DB::table('interview_interviewers')->insert([
            'interview_id'   => $interview->id,
            'interviewer_id' => auth()->id()
        ]);

        return $interview;
    }

    /**
     * @inheritDoc
     */
    public function listUpcomingInterviews(array $relations = []): Paginator {
        return Interview::query()->whereNotNull('time_slot')
            ->whereDate('time_slot', '>=', now())
            ->with($relations)
            ->simplePaginate();
    }

    /**
     * @inheritDoc
     */
    public function listPastInterviewers(array $relations = []): Paginator {
        return Interview::query()->whereNotNull('time_slot')
            ->whereDate('time_slot', '<', now())
            ->with($relations)
            ->simplePaginate();
    }

    /**
     * @inheritDoc
     */
    public function updateInterviewSchedule(Interview $interview, Carbon $interviewDate): Interview {
        $interview->fill([
            'time_slot' => $interviewDate
        ])->save();

        return $interview;
    }
}
