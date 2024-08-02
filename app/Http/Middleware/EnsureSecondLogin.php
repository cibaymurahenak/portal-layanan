<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureSecondLogin
{
    // File: app/Http/Middleware/EnsureSecondLogin.php

    public function handle(Request $request, Closure $next)
    {
        // \Log::info('Session Data:', $request->session()->all());

        // if (!$request->session()->has('api_token')) {
        //     return redirect('/login');
        // }

        // if (!$request->session()->has('sso_data')) {
        //     return redirect('/login-second');
        // }

        return $next($request);
    }

}
