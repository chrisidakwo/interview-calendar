<?php

use App\Models\Interview;
use App\Models\User;
use App\Repositories\InterviewRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InterviewTest extends TestCase {
	use RefreshDatabase;

	public function test_interviewer_can_create_interview() {
		$this->withoutExceptionHandling();

		$interviewer = User::factory()->interviewer()->create();

		$candidate = User::factory()->candidate()->create();

		$interview = Interview::factory()->candidate($candidate->id)->make();

		$this->actingAs($interviewer)->post('/interviews/new', $interview->toArray());

		$this->assertDatabaseCount('interviews', 1);
	}

	public function test_interviewer_can_add_other_interviewers() {
		$this->withoutExceptionHandling();

		$interviewer = User::factory()->interviewer()->create();

		$otherInterviewers = User::factory()->interviewer()->count(2)->create();

		$candidate = User::factory()->candidate()->create();

		$interview = Interview::factory()->candidate($candidate->id)->make();

		// Create interview
		$this->actingAs($interviewer);
		$response = $this->app[InterviewRepository::class]->storeInterview($interview->name, $interview->candidate_id);

		// Add other interviewers
		$this->actingAs($interviewer)->post("/interviews/$response->id", [
			'interviewers' => $otherInterviewers->map(function ($value) {
				return $value->id;
			})->toArray()
		]);

		$this->assertDatabaseCount('interview_interviewers', 3);

		$this->assertCount(3, $response->interviewers);
	}
}
