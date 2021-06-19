<?php

use App\Models\Interview;
use App\Models\User;
use App\Repositories\InterviewRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AvailabilityTest extends TestCase {
	use RefreshDatabase;

	public function test_can_retrieve_available_time_slots_for_an_interview() {
		// Create interviewer
		$interviewer = User::factory()->interviewer()->create();

		$this->actingAs($interviewer);

		// Create candidate
		$candidate = User::factory()->candidate(true)->create();

		// Create interview and associate candidate to interview
		$interview = Interview::factory()->candidate($candidate->id)->makeOne();

		$response = $this->app[InterviewRepository::class]->storeInterview($interview->name, $interview->candidate_id);

		// Return available time slots for interview
		$slots = $this->app[InterviewRepository::class]->getAvailableSlots($response);

		$this->assertIsArray($slots);
	}
}
