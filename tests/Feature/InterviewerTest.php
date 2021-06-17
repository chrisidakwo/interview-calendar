<?php

namespace Tests\Feature;

use App\Models\Interviewer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class InterviewerTest extends TestCase {
	use RefreshDatabase;

	public function test_valid_email_is_required() {
		$this->withoutExceptionHandling();

		$this->expectException(ValidationException::class);

		$response = $this->post('/api/interviewers', [
			'name' => 'Chris Idakwo',
			'email' => 'chrisidakwo.com'
		]);

		$response->assertSessionHasErrors();

		$response->assertSessionHasInput('email');

		$response->assertStatus(302);
	}

	public function test_create_interviewer() {
		$interviewer = Interviewer::factory()->make();

		$response = $this->post('/api/interviewers', $interviewer->toArray());

		$response->assertStatus(201);

		$this->assertTrue(count(Interviewer::all()) > 0);
	}

	public function test_interview_application_returns_as_array() {
		$interviewer = Interviewer::factory()->make();

		$this->post('/api/interviewers', $interviewer->toArray());

		$this->assertIsArray(Interviewer::query()->first()->availability);
	}
}
