<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WaypointController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
        'env' => app()->environment(),
        'php_version' => phpversion()
    ]);
});

Route::get('/', function () {
    return view('map');
});

Route::get('/test', function () {
    return view('test');
});

Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::get('/map', [WaypointController::class, 'index'])->name('map');

Route::middleware(['user.auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['admin.auth'])->group(function () {
    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');
});
