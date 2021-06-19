<?php

namespace Tests\Unit;

use App\Models\Interview;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelsTest extends TestCase {
	use RefreshDatabase;

	public function test_user_model_can_be_persisted() {
		$candidates = User::factory()->count(3)->candidate()->create();

		$this->assertDatabaseCount('users', 3);

		$this->assertInstanceOf(Collection::class, $candidates);
	}

	public function test_interview_model_can_be_persisted() {
		$interviews = Interview::factory()->count(10)->create();

		$this->assertDatabaseCount('interviews', 10);

		$this->assertInstanceOf(Collection::class, $interviews);
	}

	public function test_interviewer_can_be_created() {
		$interviewers = User::factory()->count(4)->interviewer()->create();

		$this->assertDatabaseCount('users', 4);

		$this->assertInstanceOf(Collection::class, $interviewers);
	}
}
