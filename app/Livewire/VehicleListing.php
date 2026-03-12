<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\BodyType;
use App\Models\CarModel;
use App\Models\Vehicle;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Cache;

class VehicleListing extends Component
{
    use WithPagination;

    public string $q         = '';
    public string $brand     = '';
    public string $model     = '';
    public string $body_type = '';
    public string $condition = '';
    public string $min_price = '';
    public string $max_price = '';
    public string $min_year  = '';
    public string $max_year  = '';
    public string $county    = '';
    public string $sort      = 'latest';
    public string $availability = '';

    protected $queryString = [
        'q', 'brand', 'model', 'body_type', 'condition',
        'min_price', 'max_price', 'min_year', 'max_year',
        'county', 'sort', 'availability',
    ];

    public function mount(): void
    {
        $this->q            = request('q', '');
        $this->brand        = request('brand', '');
        $this->model        = request('model', '');
        $this->body_type    = request('body_type', '');
        $this->condition    = request('condition', '');
        $this->min_price    = request('min_price', '');
        $this->max_price    = request('max_price', '');
        $this->min_year     = request('min_year', '');
        $this->max_year     = request('max_year', '');
        $this->county       = request('county', '');
        $this->sort         = request('sort', 'latest');
        $this->availability = request('availability', '');
    }

    public function updatedQ(): void         { $this->resetPage(); }
    public function updatedBrand(): void     { $this->resetPage(); $this->model = ''; }
    public function updatedBodyType(): void  { $this->resetPage(); }
    public function updatedCondition(): void { $this->resetPage(); }
    public function updatedMinPrice(): void  { $this->resetPage(); }
    public function updatedMaxPrice(): void  { $this->resetPage(); }
    public function updatedMinYear(): void   { $this->resetPage(); }
    public function updatedSort(): void      { $this->resetPage(); }

    public function clearFilters(): void
    {
        $this->reset(['q', 'brand', 'model', 'body_type', 'condition',
                      'min_price', 'max_price', 'min_year', 'max_year',
                      'county', 'availability']);
        $this->sort = 'latest';
        $this->resetPage();
    }

    public function render()
    {
        // Select only columns needed for the card — skip heavy `description` text
        $query = Vehicle::active()
            ->select([
                'id','slug','title','brand_id','car_model_id','body_type_id','user_id',
                'year','mileage','condition','transmission','fuel_type','engine_cc',
                'price','is_negotiable','county','status','is_featured','is_verified',
                'is_boosted','auto_score','cover_image_url','approved_at',
            ])
            ->with(['brand:id,name,slug', 'carModel:id,name', 'bodyType:id,name,slug', 'user:id,name,phone'])
            ->orderByDesc('is_boosted');

        // Full-text search — join brands/models to avoid subquery overhead
        if ($this->q) {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->q}%")
                  ->orWhereExists(function ($sub) {
                      $sub->selectRaw('1')->from('brands')
                          ->whereColumn('brands.id', 'vehicles.brand_id')
                          ->where('brands.name', 'like', "%{$this->q}%");
                  })
                  ->orWhereExists(function ($sub) {
                      $sub->selectRaw('1')->from('car_models')
                          ->whereColumn('car_models.id', 'vehicles.car_model_id')
                          ->where('car_models.name', 'like', "%{$this->q}%");
                  });
            });
        }

        // Use direct FK columns — avoids EXISTS subqueries
        $brandId = null;
        if ($this->brand) {
            $brandId = Cache::remember("brand_id_{$this->brand}", 3600,
                fn() => Brand::where('slug', $this->brand)->value('id'));
            if ($brandId) $query->where('brand_id', $brandId);
        }

        if ($this->model) {
            $query->where('car_model_id', $this->model);
        }

        if ($this->body_type) {
            $btId = Cache::remember("bt_id_{$this->body_type}", 3600,
                fn() => BodyType::where('slug', $this->body_type)->value('id'));
            if ($btId) $query->where('body_type_id', $btId);
        }

        if ($this->condition)    $query->where('condition', $this->condition);
        if ($this->min_price)    $query->where('price', '>=', $this->min_price);
        if ($this->max_price)    $query->where('price', '<=', $this->max_price);
        if ($this->min_year)     $query->where('year', '>=', $this->min_year);
        if ($this->max_year)     $query->where('year', '<=', $this->max_year);
        if ($this->county)       $query->where('county', $this->county);
        if ($this->availability) $query->where('availability', $this->availability);

        match($this->sort) {
            'price_asc'  => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            'mileage'    => $query->orderBy('mileage'),
            'oldest'     => $query->orderBy('year'),
            default      => $query->orderByDesc('approved_at'),
        };

        $vehicles = $query->paginate(12);
        $total    = $vehicles->total(); // reuse paginator — no extra COUNT query

        // Cache filter options (rarely change)
        $brands    = Cache::remember('filter_brands', 1800,
            fn() => Brand::where('is_active', true)->orderBy('name')->get());
        $bodyTypes = Cache::remember('filter_body_types', 1800,
            fn() => BodyType::where('is_active', true)->orderBy('sort_order')->get());
        $counties  = Cache::remember('filter_counties', 900,
            fn() => Vehicle::active()->distinct()->pluck('county')->filter()->sort()->values());

        $models = ($this->brand && $brandId)
            ? Cache::remember("models_for_{$this->brand}", 1800,
                fn() => CarModel::where('brand_id', $brandId)->where('is_active', true)->orderBy('name')->get())
            : collect();

        return view('livewire.vehicle-listing', compact(
            'vehicles', 'total', 'brands', 'bodyTypes', 'models', 'counties'
        ));
    }
}
