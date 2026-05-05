<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
<<<<<<< HEAD
        //
=======
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
>>>>>>> c0775043053153af588941b7cef0d7aab53e5f67
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
