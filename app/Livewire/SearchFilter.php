<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\BodyType;
use App\Models\CarModel;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class SearchFilter extends Component
{
    public string $condition = '';
    public string $brand_id  = '';
    public string $model_id  = '';
    public string $body_type = '';
    public string $min_price = '';
    public string $max_price = '';
    public string $min_year  = '';
    public string $max_year  = '';

    public function search(): void
    {
        $this->redirect(route('cars.index', array_filter([
            'condition' => $this->condition,
            'brand'     => $this->brand_id,
            'model'     => $this->model_id,
            'body_type' => $this->body_type,
            'min_price' => $this->min_price,
            'max_price' => $this->max_price,
            'min_year'  => $this->min_year,
            'max_year'  => $this->max_year,
        ])), navigate: true);
    }

    public function updatedBrandId(): void
    {
        $this->model_id = '';
    }

    public function render()
    {
        $brands    = Cache::remember('filter_brands', 1800,
            fn() => Brand::where('is_active', true)->orderBy('name')->get());
        $bodyTypes = Cache::remember('filter_body_types', 1800,
            fn() => BodyType::where('is_active', true)->orderBy('sort_order')->get());
        $models    = $this->brand_id
            ? Cache::remember("models_for_id_{$this->brand_id}", 1800,
                fn() => CarModel::where('brand_id', $this->brand_id)->where('is_active', true)->orderBy('name')->get())
            : collect();

        static $years = null;
        if ($years === null) {
            $years = range((int) date('Y'), 1990);
        }

        return view('livewire.search-filter', compact('brands', 'bodyTypes', 'models', 'years'));
    }
}
