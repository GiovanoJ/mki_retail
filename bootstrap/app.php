<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        /*
        |----------------------------------------------------------------------
        | Custom Middleware Aliases
        |----------------------------------------------------------------------
        | admin.auth  → Protects admin-only routes. Redirects to login if not
        |               authenticated.
        | admin.guest → Prevents logged-in admins from seeing login/register.
        |               Redirects to dashboard instead.
        */
        $middleware->alias([
            'admin.auth'  => \App\Http\Middleware\AdminAuth::class,
            'admin.guest' => \App\Http\Middleware\AdminGuest::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
