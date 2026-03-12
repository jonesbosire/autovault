<?php

namespace App\Livewire;

use App\Models\Vehicle;
use Livewire\Component;

class SaveVehicle extends Component
{
    public int $vehicleId;
    public bool $saved = false;

    public function mount(int $vehicleId): void
    {
        $this->vehicleId = $vehicleId;
        if (auth()->check()) {
            $this->saved = auth()->user()->savedVehicles()->where('vehicle_id', $vehicleId)->exists();
        }
    }

    public function toggle(): void
    {
        if (! auth()->check()) {
            $this->dispatch('toast', message: 'Sign in to save cars to your favourites', type: 'warning');
            return;
        }

        $user = auth()->user();

        if ($this->saved) {
            $user->savedVehicles()->detach($this->vehicleId);
            $this->saved = false;
            $this->dispatch('toast', message: 'Removed from favourites', type: 'info');
        } else {
            $user->savedVehicles()->syncWithoutDetaching([$this->vehicleId]);
            $this->saved = true;
            $this->dispatch('toast', message: 'Saved to favourites!', type: 'success');
        }

        // Keep saves_count in sync
        $vehicle = Vehicle::find($this->vehicleId);
        if ($vehicle) {
            $vehicle->update(['saves_count' => $vehicle->savedBy()->count()]);
        }
    }

    public function render()
    {
        return view('livewire.save-vehicle');
    }
}
