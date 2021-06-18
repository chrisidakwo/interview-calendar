<?php

namespace App\Providers;

use App\Repositories\InterviewerRepository;
use App\Repositories\InterviewRepository;
use App\Services\InterviewerService;
use App\Services\InterviewService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(InterviewRepository::class, InterviewService::class);
        $this->app->bind(InterviewerRepository::class, InterviewerService::class);
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
