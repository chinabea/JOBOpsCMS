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
            'cache' => \App\Http\Middleware\DisablePageCaching::class,
            'approved' => \App\Http\Middleware\EnsureUserIsApproved::class,
            'directors' => \App\Http\Middleware\Director::class,
            'unit-heads' => \App\Http\Middleware\UnitHead::class,
            'mict-staffs' => \App\Http\Middleware\MICTStaff::class,
            'staffs' => \App\Http\Middleware\Staff::class,
            
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
        
    })
    
    ->create();
    