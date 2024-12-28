<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
<<<<<<< HEAD
        if (!$request->is('admin/login') && !Auth::guard('admin')->check()) {
            return redirect('/');
=======
        if (Auth::guard('admin')->check()) {
            return $next($request);
>>>>>>> 9f64e7b045f88b60a0adb93d761525d625705b92
        }
    }
}
