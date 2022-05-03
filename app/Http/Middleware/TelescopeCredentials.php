<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class TelescopeCredentials
{
    /**
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        $username = 'telescopeadmin';
        $password = bcrypt('telescopeadmin');

        $request->merge(['username' => $username, 'password' => $password]);

        return $next($request);
    }
}
