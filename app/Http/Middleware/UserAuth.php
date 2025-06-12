<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if (!Auth::guard('web')->check()) {
                return redirect()->route('auth.login')->with('error', 'Please login to access this page.');
            }
            
            return $next($request);
        } catch (\Exception $e) {
            // If there's any session-related error, redirect to login
            error_log('UserAuth error: ' . $e->getMessage());
            return redirect()->route('auth.login')->with('error', 'Session error. Please login again.');
        }
    }
}