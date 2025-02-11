<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckPilotStatusMiddleware;
use App\Http\Middleware\PassengerMiddleware;
use App\Http\Middleware\PilotMiddleware;
use App\Http\Middleware\SubAdminMiddleware;
use App\Http\Middleware\SuperAdminMiddleware;
use Illuminate\Console\Scheduling\Schedule;
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
            'passenger' => PassengerMiddleware::class,
            'check.pilot.status' => CheckPilotStatusMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->booted(function () { // Add this block
        $schedule = app(Schedule::class);

        // Run the pilot deactivation command every day at midnight
        $schedule->command('pilots:deactivate-overdue')->everyMinute();
    })->create();
