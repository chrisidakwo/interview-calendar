<?php

namespace App\Repositories;

use App\Models\Interviewer;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;

interface InterviewerRepository {
	/**
	 * Return a list of interviewers.
	 *
	 * @param array $filter
	 * @param int|null $page
	 * @param int $perPage
	 * @param string[] $columns
	 * @return Paginator
	 */
	public function listInterviewers(array $filter = [], int $page = null, int $perPage = 25, $columns = ['*']): Paginator;

	/**
	 * Create a new interviewer.
	 *
	 * @param string $name
	 * @param string $email
	 * @param array $availability
	 * @return Model|Interviewer
	 */
	public function storeInterviewer(string $name, string $email, array $availability = []);
}
