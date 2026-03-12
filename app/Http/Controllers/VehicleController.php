<?php
namespace App\Http\Controllers;
use App\Models\Vehicle;
class VehicleController extends Controller
{
    public function index()
    {
        return view('pages.cars.index');
    }

    public function show(Vehicle $vehicle)
    {
        abort_if($vehicle->status !== 'active', 404);
        // Rate-limit view counts: one increment per vehicle per session
        $sessionKey = "viewed_vehicle_{$vehicle->id}";
        if (! session()->has($sessionKey)) {
            $vehicle->incrementViews();
            session()->put($sessionKey, true);
        }
        $vehicle->load(['brand','carModel','bodyType','features','user']);
        $similar = Vehicle::active()
            ->where('id', '!=', $vehicle->id)
            ->where('brand_id', $vehicle->brand_id)
            ->with(['brand','carModel','bodyType','user'])
            ->limit(4)->get();
        return view('pages.cars.show', compact('vehicle','similar'));
    }
}
