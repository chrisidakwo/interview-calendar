<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class InterviewerTest extends TestCase {
	use RefreshDatabase;

	public function test_valid_email_is_required() {
		$this->withoutExceptionHandling();

		$this->expectException(ValidationException::class);

		$admin = User::factory()->admin()->create();

		$response = $this->actingAs($admin)->post('/user', [
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

		$admin = User::factory()->admin()->create();

		$response = $this->actingAs($admin)->post('/user', [
			'name' => 'Chris Idakwo',
			'email' => 'chris.idakwo@gmail.com'
		]);

		$response->assertSessionHasErrors()
			->assertSessionHasInput('role')
			->assertStatus(302);
	}

	public function test_can_create_interviewer() {
		$interviewer = User::factory()->interviewer()->make();

		$admin = User::factory()->admin()->create();

		$response = $this->actingAs($admin)->post('/user', $interviewer->toArray());

		$response->assertStatus(201);

		$this->assertTrue(count(User::all()) > 0);
	}

	public function test_interviewer_availability_returns_as_array() {
		$interviewer = User::factory()->interviewer()->make();

		$admin = User::factory()->admin()->create();

		$this->actingAs($admin)->post('/user', $interviewer->toArray());

		$this->assertIsArray(User::query()->whereEmail($interviewer->toArray()['email'])->first()->availability);
	}

	public function test_interviewer_can_create_candidate() {
		$interviewer = User::factory()->interviewer()->create();

		$candidate = User::factory()->candidate()->make();

		$this->actingAs($interviewer)->post('/user', $candidate->toArray());

		$this->assertDatabaseHas('users', $candidate->toArray());
	}
}
