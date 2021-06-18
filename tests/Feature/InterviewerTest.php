<?php

namespace Tests\Feature;

use App\Models\Interviewer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class InterviewerTest extends TestCase {
	use RefreshDatabase;

	public function test_valid_email_is_required() {
		$this->withoutExceptionHandling();

		$this->expectException(ValidationException::class);

		$response = $this->post('/api/users', [
			'name' => 'Chris Idakwo',
			'email' => 'chrisidakwo.com'
		]);

		$response->assertSessionHasErrors();

		$response->assertSessionHasInput('email');

		$response->assertStatus(302);
	}

	public function test_valid_role_is_required() {
		$this->withoutExceptionHandling();

		$this->expectException(ValidationException::class);

		$response = $this->post('/api/users', [
			'name' => 'Chris Idakwo',
			'email' => 'chris.idakwo@gmail.com'
		]);

		$response->assertSessionHasErrors()
			->assertSessionHasInput('role')
			->assertStatus(302);
	}

	public function test_can_create_interviewer() {
		$interviewer = User::factory()->interviewer()->make();

		$response = $this->post('/api/users', $interviewer->toArray());

		$response->assertStatus(201);

		$this->assertTrue(count(User::all()) > 0);
	}

	public function test_interview_application_returns_as_array() {
		$interviewer = User::factory()->interviewer()->make();

		$this->post('/api/users', $interviewer->toArray());

		$this->assertIsArray(User::query()->first()->availability);
	}
}
