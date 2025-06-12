<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WaypointController;
Route::get('/waypoints', [WaypointController::class, 'getAllWaypoints']);
Route::post('/waypoints', [WaypointController::class, 'store']);
Route::put('/waypoints/{waypoint}', [WaypointController::class, 'update']);
Route::delete('/waypoints/{waypoint}', [WaypointController::class, 'destroy']);