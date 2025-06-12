<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Check authentication
            if (!Auth::guard('admin')->check()) {
                return redirect()->route('auth.login')->with('error', 'Please login to access the admin panel.');
            }
            
            $admin = Auth::guard('admin')->user();
            if ($admin && !$admin->is_active) {
                Auth::guard('admin')->logout();
                return redirect()->route('auth.login')->with('error', 'Your account is not active. Please contact the administrator.');
            }
            
            return $next($request);
        } catch (\Exception $e) {
            // If there's any session-related error, redirect to login
            error_log('AdminAuth error: ' . $e->getMessage());
            
            // Try to clean up any partial session state
            try {
                if (Auth::guard('admin')->check()) {
                    Auth::guard('admin')->logout();
                }
            } catch (\Exception $logoutError) {
                error_log('AdminAuth logout error: ' . $logoutError->getMessage());
            }
            
            return redirect()->route('auth.login')->with('error', 'Session error. Please login again.');
        }
    }
}