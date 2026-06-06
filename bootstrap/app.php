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
        // Enforce trusted hosts to prevent Host manipulation and proxy/metadata scanning
        $middleware->trustHosts(at: [
            'gki-pakuwon-lav.sao.dom.my.id',
            'localhost',
            '127.0.0.1',
        ]);

        // Trust reverse proxies to resolve correct client IP and secure HTTPS connections
        $middleware->trustProxies(at: '*');

        // Append custom SecurityHeaders middleware globally
        $middleware->append(\App\Http\Middleware\SecurityHeaders::class);

        $middleware->redirectUsersTo('/dashboard');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
