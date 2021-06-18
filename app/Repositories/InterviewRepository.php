<?php

namespace App\Repositories;

use App\Models\Interview;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;

interface InterviewRepository {
    /**
     * @param array $relations
     * @return Paginator
     */
    public function listInterviews(array $relations = []): Paginator;

    /**
     * @param $name
     * @param $description
     * @param $candidate
     * @return Model|Interview
     */
    public function storeInterview($name, $description, $candidate);

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
}
