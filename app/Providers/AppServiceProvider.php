<?php

namespace App\Providers;

use App\Repositories\AvailabilityRepository;
use App\Repositories\InterviewRepository;
use App\Repositories\UserRepository;
use App\Services\AvailabilityService;
use App\Services\InterviewService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(InterviewRepository::class, InterviewService::class);
        $this->app->bind(UserRepository::class, UserService::class);
        $this->app->bind(AvailabilityRepository::class, AvailabilityService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //
    }
}
