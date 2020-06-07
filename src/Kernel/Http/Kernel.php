<?php
/**
 * Created by PhpStorm.
 */

namespace WebAppId\DDD\Kernel\Http;

use WebAppId\User\Middleware\RoleCheck;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 01/06/2020
 * Time: 10.47
 * Class Kernel
 * @package DyanGalih\Payment\Kernel
 */
class Kernel extends \Orchestra\Testbench\Http\Kernel
{
    protected $routeMiddleware = [
        'role' => RoleCheck::class,
        'auth' => \Orchestra\Testbench\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \Orchestra\Testbench\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
