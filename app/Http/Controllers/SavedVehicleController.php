<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class SavedVehicleController extends Controller
{
    public function index()
    {
        $saved = auth()->user()
            ->savedVehicles()
            ->with(['brand', 'bodyType'])
            ->where('vehicles.status', 'active')
            ->latest('saved_vehicles.created_at')
            ->paginate(12);

        return view('pages.my-favorites', compact('saved'));
    }

    public function toggle(Vehicle $vehicle)
    {
        $user = auth()->user();

        if ($user->savedVehicles()->where('vehicle_id', $vehicle->id)->exists()) {
            $user->savedVehicles()->detach($vehicle->id);
            $saved = false;
            $message = 'Removed from favourites';
        } else {
            $user->savedVehicles()->syncWithoutDetaching([$vehicle->id]);
            $saved = true;
            $message = 'Saved to favourites!';
        }

        $vehicle->update(['saves_count' => $vehicle->savedBy()->count()]);

        if (request()->expectsJson()) {
            return response()->json(['saved' => $saved, 'message' => $message]);
        }

        return back()->with($saved ? 'success' : 'info', $message);
    }
}
