<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',

        then: function () {
            // Route::group([],base_path('routes/admin.php'));
            Route::group([],base_path('routes/admin.php'))
                ->prefix('admin')
                ->middleware('web','Admin')
                ->namespace('admin')
                ->name('admin.');

        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'Admin' => AdminMiddleware::class ,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
