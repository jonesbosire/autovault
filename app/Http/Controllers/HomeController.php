<?php
namespace App\Http\Controllers;
use App\Models\BodyType;
use App\Models\Brand;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Cache;
class HomeController extends Controller
{
    public function index()
    {
        $featuredVehicles = Cache::remember('home_featured', 300,
            fn() => Vehicle::active()->where('is_featured', true)
                ->with(['brand','carModel','bodyType','user'])
                ->orderByDesc('is_boosted')->orderByDesc('approved_at')
                ->limit(8)->get()
        );

        $recentVehicles = Cache::remember('home_recent', 120,
            fn() => Vehicle::active()
                ->with(['brand','carModel','bodyType','user'])
                ->orderByDesc('approved_at')
                ->limit(8)->get()
        );

        $popularBrands = Cache::remember('home_popular_brands', 3600,
            fn() => Brand::where('is_popular', true)->where('is_active', true)->orderBy('sort_order')->get()
        );

        $bodyTypes = Cache::remember('filter_body_types', 1800,
            fn() => BodyType::where('is_active', true)->orderBy('sort_order')->get()
        );

        $stats = Cache::remember('home_stats', 600, function () {
            $row = Vehicle::active()
                ->selectRaw('COUNT(*) as total, SUM(is_featured) as featured')
                ->first();
            return [
                'total'    => (int) $row->total,
                'featured' => (int) $row->featured,
                'brands'   => Brand::where('is_active', true)->count(),
            ];
        });

        return view('pages.home', compact('featuredVehicles','recentVehicles','popularBrands','bodyTypes','stats'));
    }
}
