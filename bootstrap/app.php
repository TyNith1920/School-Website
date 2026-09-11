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
        
        // 📍 ថែមបន្ទាត់នេះ ដើម្បីប្រាប់ Laravel ឱ្យទុកចិត្តប្រព័ន្ធរបស់ Render (ជួយដោះស្រាយបញ្ហា Upload រូបភាព)
        $middleware->trustProxies(at: '*');

        $middleware->web(append: [
            \App\Http\Middleware\LanguageMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();