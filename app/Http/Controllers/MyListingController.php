<?php
namespace App\Http\Controllers;
use App\Models\Vehicle;
use Illuminate\Http\Request;
class MyListingController extends Controller
{
    public function index() { $listings = auth()->user()->vehicles()->with(['brand','carModel'])->latest()->paginate(10); return view('pages.my-listings.index', compact('listings')); }
    public function create() { return view('pages.my-listings.create'); }
    public function store(Request $request) { return redirect()->route('my-listings.index'); }
    public function show(Vehicle $vehicle) { abort_if($vehicle->user_id !== auth()->id() && !auth()->user()->isAdmin(), 403); return view('pages.my-listings.show', compact('vehicle')); }
}
