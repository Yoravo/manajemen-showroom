<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Direct the user to the dashboard if they are not an admin
        if (Auth::user()->usertype != 'admin'){
            return redirect('/');
        }
        return $next($request);
    }
}
