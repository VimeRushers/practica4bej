<?php
namespace App\Http\Controllers;
use App\Models\AdminUser;
use App\Models\LoginLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        $username = $request->input('username');
        $password = $request->input('password');
        $adminUser = AdminUser::where('username', $username)->first();
        $regularUser = User::where('username', $username)->first();
        $loginLog = LoginLog::create([
            'admin_user_id' => $adminUser ? $adminUser->id : null,
            'username' => $username,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'failed', 
            'failure_reason' => null,
            'login_at' => now(),
        ]);
        if ($adminUser && $adminUser->username === 'admin') {
            if (!$adminUser->is_active) {
                $loginLog->update([
                    'failure_reason' => 'Admin account inactive'
                ]);
                throw ValidationException::withMessages([
                    'username' => ['Admin account is inactive.'],
                ]);
            }
            if (!Hash::check($password, $adminUser->password)) {
                $loginLog->update([
                    'failure_reason' => 'Invalid admin password'
                ]);
                throw ValidationException::withMessages([
                    'password' => ['Invalid credentials.'],
                ]);
            }
            $loginLog->update([
                'status' => 'success',
                'failure_reason' => null,
            ]);
            $adminUser->update([
                'last_login_at' => now(),
                'last_login_ip' => $request->ip(),
            ]);
            Auth::guard('admin')->login($adminUser);
            return redirect()->intended('/admin')->with('success', 'Welcome back, Admin!');
        }
        if ($regularUser) {
            if (!Hash::check($password, $regularUser->password)) {
                $loginLog->update([
                    'failure_reason' => 'Invalid user password'
                ]);
                throw ValidationException::withMessages([
                    'password' => ['Invalid credentials.'],
                ]);
            }
            $loginLog->update([
                'status' => 'success',
                'failure_reason' => null,
            ]);
            Auth::guard('web')->login($regularUser);
            return redirect()->intended('/map')->with('success', 'Welcome back, ' . $regularUser->name . '!');
        }
        $loginLog->update([
            'failure_reason' => 'Username not found'
        ]);
        throw ValidationException::withMessages([
            'username' => ['Invalid credentials.'],
        ]);
    }
    public function showRegister()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($request->username === 'admin') {
            throw ValidationException::withMessages([
                'username' => ['Username "admin" is reserved. Please choose a different username.'],
            ]);
        }
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        LoginLog::create([
            'admin_user_id' => null, 
            'username' => $user->username,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'success',
            'failure_reason' => null,
            'login_at' => now(),
        ]);
        Auth::guard('web')->login($user);
        return redirect('/map')->with('success', 'Account created successfully! Welcome, ' . $user->name . '!');
    }
    public function logout(Request $request)
    {
        $adminUser = Auth::guard('admin')->user();
        $regularUser = Auth::guard('web')->user();
        $username = 'Unknown';
        if ($adminUser) {
            $username = $adminUser->username;
            Auth::guard('admin')->logout();
        } elseif ($regularUser) {
            $username = $regularUser->name;
            Auth::guard('web')->logout();
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login')->with('success', "You have been logged out successfully, {$username}!");
    }
}