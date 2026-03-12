<?php

namespace App\Livewire;

use App\Models\Enquiry;
use App\Models\Vehicle;
use Livewire\Component;

class EnquiryForm extends Component
{
    public int    $vehicleId;
    public string $name    = '';
    public string $email   = '';
    public string $phone   = '';
    public string $message = '';
    public bool   $sent    = false;

    protected $rules = [
        'name'    => 'required|string|max:100',
        'email'   => 'required|email|max:150',
        'phone'   => 'nullable|string|max:20',
        'message' => 'required|string|max:1000',
    ];

    public function submit(): void
    {
        $this->validate();

        Enquiry::create([
            'vehicle_id' => $this->vehicleId,
            'name'       => $this->name,
            'email'      => $this->email,
            'phone'      => $this->phone,
            'message'    => $this->message,
            'ip_address' => request()->ip(),
        ]);

        Vehicle::find($this->vehicleId)?->increment('enquiries_count');

        $this->reset(['name', 'email', 'phone', 'message']);
        $this->sent = true;
        $this->dispatch('toast', message: 'Your enquiry has been sent! The seller will contact you soon.', type: 'success');
    }

    public function render()
    {
        return view('livewire.enquiry-form');
    }
}
