<?php

namespace Salesfly\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Salesfly\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Salesfly\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Salesfly\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \Salesfly\Http\Middleware\RedirectIfAuthenticated::class,
        'role' => \Salesfly\Http\Middleware\RoleMiddleware::class,
        'cashier' => \Salesfly\Http\Middleware\CashierMiddleware::class,
        'role-cashier' => \Salesfly\Http\Middleware\RoleCashierMiddleware::class,
        'role-asistant' => \Salesfly\Http\Middleware\RoleAsistantMiddleware::class,
        'role-cashier-asistant' => \Salesfly\Http\Middleware\RoleCashierAsistantMiddleware::class
    ];
}
