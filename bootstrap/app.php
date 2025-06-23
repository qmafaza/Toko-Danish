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
    ->withMiddleware(function (Middleware $middleware) {
         
        $middleware->alias([

            'seller' => \App\Http\Middleware\Seller::class,

            
        ]);

    //     $middleware->trustProxies(at: [
    //     '0.0.0.0/0',
    //     '*.railway.app'
    // ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
