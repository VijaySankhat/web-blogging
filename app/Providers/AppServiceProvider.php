<?php

namespace App\Providers;
use App\Services\PostImportService;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        //Code to update the import progress status
        Queue::after(function (JobProcessed $event) {
            Log::info("Post import success");
            (new PostImportService())->updateImportStatus($event->job->getJobId(), true);
        });

        //$this->addQueryLog();
    }

    private function addQueryLog() {
        DB::listen(function($query) {
            Log::info(
                $query->sql,
                $query->bindings,
                $query->time
            );
        });
    }

}
