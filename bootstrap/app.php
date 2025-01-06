<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\PassengerMiddleware;
use App\Http\Middleware\PilotMiddleware;
use App\Http\Middleware\SubAdminMiddleware;
use App\Http\Middleware\SuperAdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([
            'super_admin' => SuperAdminMiddleware::class,
            'admin' => AdminMiddleware::class,
            'sub_admin' => SubAdminMiddleware::class,
            'pilot' => PilotMiddleware::class,
            'passenger' => PassengerMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
