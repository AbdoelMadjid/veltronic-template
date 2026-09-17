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
        $middleware->encryptCookies(except: [
            'kt_lang',
            'data-kt-lang',
            'kt_icon_style',
            'data-kt-icon-style',
        ]);
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->report(function (\Throwable $e) {
            // Ignore standard validation, authentication redirection, and 404 not found exceptions
            if (
                $e instanceof \Illuminate\Validation\ValidationException ||
                $e instanceof \Illuminate\Auth\AuthenticationException ||
                $e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
            ) {
                return;
            }

            try {
                $fileRel = str_replace(base_path(), '', $e->getFile());
                \App\Models\Profil\UserLog::record(
                    module: 'sistem',
                    menu: 'backend_error',
                    activity: 'Backend Exception: ' . class_basename($e),
                    description: $e->getMessage() . ' di ' . $fileRel . ':' . $e->getLine(),
                    level: 'error'
                );
            } catch (\Throwable $ignored) {
                // Ensure logging failure never breaks application flow
            }
        });
    })->create();
