<?php

namespace App\Providers;

use App\Models\Team;
use App\Policies\TeamPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Response as HttpStatus;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Team::class, TeamPolicy::class);

        Response::macro('ok', function ($value) {
            return Response::json($value, HttpStatus::HTTP_OK);
        });

        Response::macro('created', function ($value) {
            return Response::json($value, HttpStatus::HTTP_CREATED);
        });

        Response::macro('notfound', function ($value) {
            return Response::json($value, HttpStatus::HTTP_NOT_FOUND);
        });

        Response::macro('unprocessableentity', function ($value) {
            return Response::json($value, HttpStatus::HTTP_UNPROCESSABLE_ENTITY);
        });

        Response::macro('unauthorized', function ($value) {
            return Response::json($value, HttpStatus::HTTP_UNAUTHORIZED);
        });

        Response::macro('forbidden', function ($value) {
            return Response::json($value, HttpStatus::HTTP_FORBIDDEN);
        });

        Response::macro('servererror', function ($value) {
            return Response::json($value, HttpStatus::HTTP_INTERNAL_SERVER_ERROR);
        });
    }
}
