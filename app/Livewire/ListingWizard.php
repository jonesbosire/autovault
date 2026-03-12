<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\BodyType;
use App\Models\CarModel;
use App\Models\Feature;
use App\Models\SubscriptionPlan;
use App\Models\Vehicle;
use Illuminate\Support\Str;
use Livewire\Component;

class ListingWizard extends Component
{
    public int $step = 1;
    public int $totalSteps = 4;

    public ?int $brand_id = null;
    public ?int $car_model_id = null;
    public int $year = 2020;
    public string $condition = 'foreign_used';
    public int $mileage = 0;
    public string $transmission = 'automatic';
    public string $fuel_type = 'petrol';

    public ?string $title = null;
    public ?int $body_type_id = null;
    public ?string $engine_cc = null;
    public ?string $drive_type = null;
    public ?string $color = null;
    public int $doors = 4;
    public int $seats = 5;
    public ?string $interior_color = null;
    public ?string $description = null;
    public int $price = 0;
    public bool $is_negotiable = false;
    public ?string $county = null;
    public ?string $location_text = null;
    public string $availability = 'local';
    public ?string $import_country = null;
    public array $selected_features = [];

    public ?int $selected_plan_id = null;
    public bool $submitted = false;
    public ?int $created_vehicle_id = null;

    protected function rules(): array
    {
        return match($this->step) {
            1 => [
                'brand_id'     => ['required', 'exists:brands,id'],
                'car_model_id' => ['required', 'exists:car_models,id'],
                'year'         => ['required', 'integer', 'min:1990', 'max:'.(date('Y') + 1)],
                'condition'    => ['required', 'in:new,foreign_used,locally_used'],
                'mileage'      => ['required', 'integer', 'min:0'],
                'transmission' => ['required', 'in:automatic,manual,cvt,hybrid'],
                'fuel_type'    => ['required', 'in:petrol,diesel,hybrid,electric,lpg'],
            ],
            2 => [
                'title'       => ['required', 'string', 'min:5', 'max:255'],
                'price'       => ['required', 'integer', 'min:10000'],
                'county'      => ['required', 'string'],
                'description' => ['nullable', 'string'],
            ],
            3 => [
                'selected_plan_id' => ['required', 'exists:subscription_plans,id'],
            ],
            default => [],
        };
    }

    public function updatedBrandId(): void
    {
        $this->car_model_id = null;
        $this->autoGenerateTitle();
    }

    public function updatedCarModelId(): void
    {
        $this->autoGenerateTitle();
    }

    public function updatedYear(): void
    {
        $this->autoGenerateTitle();
    }

    private function autoGenerateTitle(): void
    {
        if ($this->brand_id && $this->car_model_id && $this->year) {
            $brand = Brand::find($this->brand_id);
            $model = CarModel::find($this->car_model_id);
            if ($brand && $model) {
                $this->title = "{$this->year} {$brand->name} {$model->name}";
            }
        }
    }

    public function nextStep(): void
    {
        $this->validate();
        if ($this->step < $this->totalSteps) {
            $this->step++;
        }
    }

    public function prevStep(): void
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function selectPlan(int $planId): void
    {
        $this->selected_plan_id = $planId;
    }

    public function submit(): void
    {
        $user = auth()->user();
        $status = $user->hasActiveSubscription() ? 'pending_review' : 'pending_payment';
        $slug = strtolower(Str::slug($this->title) . '-' . Str::random(6));

        $vehicle = Vehicle::create([
            'user_id'        => $user->id,
            'brand_id'       => $this->brand_id,
            'car_model_id'   => $this->car_model_id,
            'body_type_id'   => $this->body_type_id,
            'title'          => $this->title,
            'slug'           => $slug,
            'year'           => $this->year,
            'condition'      => $this->condition,
            'mileage'        => $this->mileage,
            'transmission'   => $this->transmission,
            'fuel_type'      => $this->fuel_type,
            'engine_cc'      => $this->engine_cc,
            'drive_type'     => $this->drive_type,
            'color'          => $this->color,
            'doors'          => $this->doors,
            'seats'          => $this->seats,
            'interior_color' => $this->interior_color,
            'description'    => $this->description,
            'price'          => $this->price,
            'is_negotiable'  => $this->is_negotiable,
            'currency'       => 'KES',
            'county'         => $this->county,
            'location_text'  => $this->location_text,
            'availability'   => $this->availability,
            'import_country' => $this->import_country,
            'status'         => $status,
            'expires_at'     => now()->addDays(60),
        ]);

        if (!empty($this->selected_features)) {
            $vehicle->features()->attach($this->selected_features);
        }

        $this->created_vehicle_id = $vehicle->id;
        $this->submitted = true;
        $this->dispatch('toast', message: 'Your listing has been submitted successfully!', type: 'success');
    }

    public function render()
    {
        $brands    = Brand::where('is_active', true)->orderBy('name')->get();
        $models    = $this->brand_id
            ? CarModel::where('brand_id', $this->brand_id)->where('is_active', true)->orderBy('name')->get()
            : collect();
        $bodyTypes = BodyType::where('is_active', true)->orderBy('sort_order')->get();
        $features  = Feature::where('is_active', true)->orderBy('category')->orderBy('name')->get()->groupBy('category');
        $plans     = SubscriptionPlan::where('is_active', true)->orderBy('sort_order')->get();
        $user      = auth()->user();
        $years     = range(date('Y') + 1, 1990);

        return view('livewire.listing-wizard', compact(
            'brands', 'models', 'bodyTypes', 'features', 'plans', 'user', 'years'
        ));
    }
}
