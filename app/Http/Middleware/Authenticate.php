<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (Route::has('login')) {
            return $request->expectsJson() ? null : route('login');
        } else {
            return $request->expectsJson() ? null : route('admin.login');
        }
    }
}
