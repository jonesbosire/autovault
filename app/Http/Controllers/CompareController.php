<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    private const MAX = 3;
    private const KEY = 'compare_ids';

    public function show()
    {
        $ids      = session(self::KEY, []);
        $vehicles = Vehicle::with(['brand', 'carModel', 'bodyType', 'features'])
            ->whereIn('id', $ids)
            ->where('status', 'active')
            ->get()
            ->sortBy(fn($v) => array_search($v->id, $ids))
            ->values();

        return view('pages.compare', compact('vehicles'));
    }

    public function toggle(Vehicle $vehicle)
    {
        $ids = session(self::KEY, []);

        if (in_array($vehicle->id, $ids)) {
            $ids = array_values(array_filter($ids, fn($id) => $id !== $vehicle->id));
            $msg  = 'Removed from compare';
            $type = 'info';
        } elseif (count($ids) >= self::MAX) {
            $msg  = 'Compare list is full (max ' . self::MAX . '). Remove a car first.';
            $type = 'warning';
            session([self::KEY => $ids]);
            return back()->with($type, $msg);
        } else {
            $ids[] = $vehicle->id;
            $msg   = "Added to compare ({$vehicle->title})";
            $type  = 'success';
        }

        session([self::KEY => $ids]);

        if (request()->expectsJson()) {
            return response()->json(['count' => count($ids), 'ids' => $ids, 'message' => $msg]);
        }

        return back()->with($type, $msg);
    }

    public function remove(Vehicle $vehicle)
    {
        $ids = session(self::KEY, []);
        $ids = array_values(array_filter($ids, fn($id) => $id !== $vehicle->id));
        session([self::KEY => $ids]);

        return back()->with('info', 'Removed from compare');
    }

    public function clear()
    {
        session()->forget(self::KEY);
        return back()->with('info', 'Compare list cleared');
    }
}
