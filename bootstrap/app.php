<?php

use App\Responses\HttpNotFoundResponse;
use App\Responses\HttpServerErrorResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        apiPrefix: 'api'
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthenticationException $e) {
            return response()->json([], 401);
        });

        $exceptions->render(function (QueryException $e) {
            return HttpServerErrorResponse::build(
                new Collection([]),
                'Something went wrong, talk to the API admin to sort it out.'
            );
        });

        $exceptions->render(function (NotFoundHttpException $e) {
            return HttpNotFoundResponse::build(
                new Collection([]),
                'Hum? if you are seeing this is because something was not found. Check the body of the request and any params within the URL.'
            );
        });
    })->create();
