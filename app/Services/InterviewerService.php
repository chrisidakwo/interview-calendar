<?php

namespace App\Services;

use App\Models\Interviewer;
use App\Repositories\InterviewerRepository;
use Illuminate\Contracts\Pagination\Paginator;

class InterviewerService implements InterviewerRepository {
	/**
	 * @inheritDoc
	 */
	public function storeInterviewer(string $name, string $email, array $availability = []) {
		// Build availability

		return Interviewer::query()->create([
			'name' => $name,
			'email' => $email,
			'availability' => $availability
		]);
	}

	/**
	 * @inheritDoc
	 */
	public function listInterviewers(array $filter = [], int $page = null, int $perPage = 25, $columns = ['*']): Paginator {
		return Interviewer::query()->simplePaginate($perPage, $columns, 'page', $page);
	}
}
