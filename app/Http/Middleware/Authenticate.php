<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request): ?string
    {
        if (!$request->expectsJson()) {
            if ($request->is('staff/*')) {
                return route('staff.login');
            }

            if ($request->is('client/*')) {
                return route('client.login');
            }
        }

        return route('index');
    }
}
