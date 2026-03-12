<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user     = auth()->user();
        $vehicles = $user->vehicles();

        $stats = [
            'total'     => $vehicles->count(),
            'active'    => $vehicles->where('status', 'active')->count(),
            'pending'   => $vehicles->whereIn('status', ['pending_review', 'pending_payment'])->count(),
            'views'     => $vehicles->sum('views_count'),
            'enquiries' => $vehicles->sum('enquiries_count'),
            'saved'     => $user->savedVehicles()->count(),
        ];

        $recentListings = $user->vehicles()
            ->with(['brand', 'carModel'])
            ->latest()
            ->take(6)
            ->get();

        $recentSaved = $user->savedVehicles()
            ->with(['brand', 'bodyType'])
            ->latest('saved_vehicles.created_at')
            ->take(4)
            ->get();

        return view('pages.dashboard', compact('stats', 'recentListings', 'recentSaved'));
    }
}
