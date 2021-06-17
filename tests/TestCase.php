<?php

namespace Tests;

use Database\Seeders\TimeSlotsTableSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase {
	use CreatesApplication;

	protected function setUp(): void {
		parent::setUp();

		// Seed time slots
		$this->seed(TimeSlotsTableSeeder::class);
	}
}
