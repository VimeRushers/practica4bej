<?php
namespace App\Http\Controllers;
use App\Models\Waypoint;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
class WaypointController extends Controller
{
    public function index()
    {
        return view('map');
    }
    public function getAllWaypoints(): JsonResponse
    {
        $waypoints = Waypoint::all();
        return response()->json($waypoints);
    }
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'icon' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:7'
        ]);
        $waypoint = Waypoint::create($validated);
        return response()->json([
            'success' => true,
            'waypoint' => $waypoint
        ], 201);
    }
    public function update(Request $request, Waypoint $waypoint): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'icon' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:7'
        ]);
        $waypoint->update($validated);
        return response()->json([
            'success' => true,
            'waypoint' => $waypoint
        ]);
    }
    public function destroy(Waypoint $waypoint): JsonResponse
    {
        $waypoint->delete();
        return response()->json([
            'success' => true,
            'message' => 'Waypoint deleted successfully'
        ]);
    }
}