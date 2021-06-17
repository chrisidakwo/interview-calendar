<?php

namespace Tests\Unit;

use App\Domain\Interview\Models\Candidate;
use App\Domain\Interview\Models\Interview;
use App\Domain\Interview\Models\Interviewer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelsTest extends TestCase {
	use RefreshDatabase;

	/**
	 * A basic unit test example.
	 *
	 * @return void
	 */
	public function test_candidate_model_can_be_persisted() {
		$candidates = Candidate::factory()->count(3)->create();

		$this->assertDatabaseCount('candidates', 3);

		$this->assertInstanceOf(Collection::class, $candidates);
	}

	public function test_interview_model_can_be_persisted() {
		$interviews = Interview::factory()->count(10)->create();

		$this->assertDatabaseCount('interviews', 10);

		$this->assertInstanceOf(Collection::class, $interviews);
	}

	public function test_interviewer_model_can_be_persisted() {
		$interviewers = Interviewer::factory()->count(4)->create();

		$this->assertDatabaseCount('interviewers', 4);

		$this->assertInstanceOf(Collection::class, $interviewers);
	}
}
