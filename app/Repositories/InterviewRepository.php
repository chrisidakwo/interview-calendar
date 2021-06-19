<?php

namespace App\Repositories;

use App\Models\Interview;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;

interface InterviewRepository {
    /**
     * @param array $relations
     * @param array $filters
     * @return Paginator
     */
    public function listInterviews(array $relations = [], array $filters = []): Paginator;

    /**
     * @param string $name
     * @param string $candidate
     * @param string|null $description
     * @param null $minBookingDate
     * @param null $maxBookingDate
     * @return Model|Interview
     */
    public function storeInterview(string $name, string $candidate, string $description = null, $minBookingDate = null, $maxBookingDate = null);

    /**
     * @param array $relations
     * @return Paginator
     */
    public function listUpcomingInterviews(array $relations = []): Paginator;

    /**
     * @param array $relations
     * @return Paginator
     */
    public function listPastInterviewers(array $relations = []): Paginator;

    /**
     * @param Interview $interview
     * @param Carbon $interviewDate
     * @return Interview
     */
    public function updateInterviewSchedule(Interview $interview, Carbon $interviewDate): Interview;

    /**
     * @param Interview $interview
     * @param array $interviewers
     * @return Interview
     */
    public function updateInterviewers(Interview $interview, array $interviewers): Interview;
}
