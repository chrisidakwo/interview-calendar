<?php

namespace App\Services;

use App\Models\Interview;
use App\Repositories\InterviewRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class InterviewService implements InterviewRepository {
    /**
     * @inheritDoc
     */
    public function listInterviews(array $relations = []): Paginator {
        return Interview::query()->with($relations)->simplePaginate();
    }

    /**
     * @inheritDoc
     */
    public function storeInterview($name, $description, $candidate) {
        /** @var Interview $interview */
        $interview = Interview::query()->create([
            'id'           => Uuid::uuid4()->toString(),
            'name'         => $name,
            'description'  => $description,
            'candidate_id' => $candidate
        ]);

        DB::table('interview_interviewers')->insert([
            'interview_id'   => $interview->id,
            'interviewer_id' => auth()->id()
        ]);
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
}
