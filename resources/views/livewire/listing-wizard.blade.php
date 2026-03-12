<div>
{{-- ══════════════════════════════════════════════
     SUCCESS STATE
══════════════════════════════════════════════ --}}
@if($submitted)
    <div style="text-align:center;padding:60px 20px;">
        <div style="font-size:64px;margin-bottom:16px;"></div>
        <h3 style="color:var(--primary);margin-bottom:8px;">Listing Submitted!</h3>
        <p style="color:var(--color-text);margin-bottom:24px;">
            @if(auth()->user()->hasActiveSubscription())
                Your listing is now under review. We'll activate it within 24 hours.
            @else
                Your listing is saved. Complete payment to make it go live.
            @endif
        </p>
        <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
            <a href="{{ route('my-listings.index') }}" wire:navigate class="sc-button" style="justify-content:center;">
                View My Listings
            </a>
            @if(!auth()->user()->hasActiveSubscription())
                <a href="{{ route('pricing') }}" wire:navigate class="sc-button" style="justify-content:center;background:transparent;color:var(--primary);border:2px solid var(--primary);">
                    Get a Plan
                </a>
            @endif
        </div>
    </div>

@else
{{-- ══════════════════════════════════════════════
     PROGRESS STEPS
══════════════════════════════════════════════ --}}
<div class="wizard-steps" style="display:flex;align-items:center;margin-bottom:32px;gap:0;">
    @foreach([1 => 'Vehicle Info', 2 => 'Details', 3 => 'Plan & Pay', 4 => 'Review'] as $s => $label)
        <div style="display:flex;align-items:center;flex:1;">
            <div style="display:flex;flex-direction:column;align-items:center;min-width:80px;">
                <div style="width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;
                    background:{{ $step >= $s ? 'var(--color-main)' : '#e2e8f0' }};
                    color:{{ $step >= $s ? '#fff' : '#94a3b8' }};
                    cursor:{{ $step > $s ? 'pointer' : 'default' }};"
                    @if($step > $s) wire:click="goToStep({{ $s }})" @endif>
                    {{ $step > $s ? '✓' : $s }}
                </div>
                <span style="font-size:11px;margin-top:4px;font-weight:{{ $step === $s ? 600 : 400 }};color:{{ $step >= $s ? 'var(--primary)' : '#94a3b8' }};">
                    {{ $label }}
                </span>
            </div>
            @if($s < 4)
                <div style="flex:1;height:2px;background:{{ $step > $s ? 'var(--color-main)' : '#e2e8f0' }};margin:0 4px;margin-bottom:20px;"></div>
            @endif
        </div>
    @endforeach
</div>

{{-- Validation Errors --}}
@if($errors->any())
    <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:12px 16px;margin-bottom:20px;">
        @foreach($errors->all() as $error)
            <div style="color:#dc2626;font-size:13px;">• {{ $error }}</div>
        @endforeach
    </div>
@endif

{{-- ══════════════════════════════════════════════
     STEP 1 — Vehicle Identity
══════════════════════════════════════════════ --}}
@if($step === 1)
<div class="wizard-step">
    <h5 style="color:var(--primary);margin-bottom:20px;">Tell us about the car</h5>
    <div class="row">
        <div class="col-md-6 mb-16">
            <label class="form-label-sm">Make / Brand *</label>
            <select wire:model.live="brand_id" class="wizard-select">
                <option value="">Select Brand</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
            @error('brand_id') <span class="field-error">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-6 mb-16">
            <label class="form-label-sm">Model *</label>
            <select wire:model.live="car_model_id" class="wizard-select" @if(!$brand_id) disabled @endif>
                <option value="">{{ $brand_id ? 'Select Model' : 'Select brand first' }}</option>
                @foreach($models as $model)
                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                @endforeach
            </select>
            @error('car_model_id') <span class="field-error">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-4 mb-16">
            <label class="form-label-sm">Year *</label>
            <select wire:model.live="year" class="wizard-select">
                @foreach($years as $y)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endforeach
            </select>
            @error('year') <span class="field-error">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-4 mb-16">
            <label class="form-label-sm">Condition *</label>
            <select wire:model.live="condition" class="wizard-select">
                <option value="foreign_used">Foreign Used</option>
                <option value="locally_used">Locally Used</option>
                <option value="new">Brand New</option>
            </select>
        </div>
        <div class="col-md-4 mb-16">
            <label class="form-label-sm">Mileage (km) *</label>
            <input wire:model="mileage" type="number" min="0" class="wizard-input" placeholder="e.g. 45000">
            @error('mileage') <span class="field-error">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-6 mb-16">
            <label class="form-label-sm">Transmission *</label>
            <select wire:model="transmission" class="wizard-select">
                <option value="automatic">Automatic</option>
                <option value="manual">Manual</option>
                <option value="cvt">CVT</option>
                <option value="hybrid">Hybrid Auto</option>
            </select>
        </div>
        <div class="col-md-6 mb-16">
            <label class="form-label-sm">Fuel Type *</label>
            <select wire:model="fuel_type" class="wizard-select">
                <option value="petrol">Petrol</option>
                <option value="diesel">Diesel</option>
                <option value="hybrid">Hybrid</option>
                <option value="electric">Electric</option>
                <option value="lpg">LPG</option>
            </select>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════
     STEP 2 — Details & Features
══════════════════════════════════════════════ --}}
@elseif($step === 2)
<div class="wizard-step">
    <h5 style="color:var(--primary);margin-bottom:20px;">Listing Details</h5>
    <div class="row">
        <div class="col-12 mb-16">
            <label class="form-label-sm">Listing Title *</label>
            <input wire:model="title" type="text" class="wizard-input" placeholder="e.g. 2020 Toyota RAV4 Hybrid">
            @error('title') <span class="field-error">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-6 mb-16">
            <label class="form-label-sm">Asking Price (KES) *</label>
            <input wire:model="price" type="number" min="0" class="wizard-input" placeholder="e.g. 3500000">
            @error('price') <span class="field-error">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-6 mb-16" style="display:flex;align-items:flex-end;padding-bottom:4px;">
            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:14px;">
                <input wire:model="is_negotiable" type="checkbox" style="width:18px;height:18px;">
                Price is negotiable
            </label>
        </div>
        <div class="col-md-4 mb-16">
            <label class="form-label-sm">Body Type</label>
            <select wire:model="body_type_id" class="wizard-select">
                <option value="">Select Body Type</option>
                @foreach($bodyTypes as $bt)
                    <option value="{{ $bt->id }}">{{ $bt->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 mb-16">
            <label class="form-label-sm">Engine (cc)</label>
            <input wire:model="engine_cc" type="text" class="wizard-input" placeholder="e.g. 2000">
        </div>
        <div class="col-md-4 mb-16">
            <label class="form-label-sm">Drive Type</label>
            <select wire:model="drive_type" class="wizard-select">
                <option value="">Select</option>
                <option value="2wd">2WD</option>
                <option value="4wd">4WD</option>
                <option value="awd">AWD</option>
                <option value="4x4">4x4</option>
            </select>
        </div>
        <div class="col-md-4 mb-16">
            <label class="form-label-sm">Exterior Color</label>
            <input wire:model="color" type="text" class="wizard-input" placeholder="e.g. Pearl White">
        </div>
        <div class="col-md-4 mb-16">
            <label class="form-label-sm">Doors</label>
            <select wire:model="doors" class="wizard-select">
                @foreach([2,3,4,5] as $d)
                    <option value="{{ $d }}">{{ $d }} doors</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 mb-16">
            <label class="form-label-sm">Seats</label>
            <select wire:model="seats" class="wizard-select">
                @foreach([2,4,5,6,7,8,9] as $s)
                    <option value="{{ $s }}">{{ $s }} seats</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-16">
            <label class="form-label-sm">County / Region *</label>
            <select wire:model="county" class="wizard-select">
                <option value="">Select County</option>
                @foreach(['Nairobi','Mombasa','Kisumu','Nakuru','Eldoret','Thika','Kisii','Nyeri','Machakos','Meru','Other'] as $c)
                    <option value="{{ $c }}">{{ $c }}</option>
                @endforeach
            </select>
            @error('county') <span class="field-error">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-6 mb-16">
            <label class="form-label-sm">Exact Location</label>
            <input wire:model="location_text" type="text" class="wizard-input" placeholder="e.g. Westlands, Nairobi">
        </div>
        <div class="col-md-6 mb-16">
            <label class="form-label-sm">Availability</label>
            <select wire:model.live="availability" class="wizard-select">
                <option value="local">Available in Kenya (ready to view)</option>
                <option value="import">Direct Import / Order</option>
            </select>
        </div>
        @if($availability === 'import')
        <div class="col-md-6 mb-16">
            <label class="form-label-sm">Import From</label>
            <input wire:model="import_country" type="text" class="wizard-input" placeholder="e.g. Japan, UAE, UK">
        </div>
        @endif
        <div class="col-12 mb-16">
            <label class="form-label-sm">Description</label>
            <textarea wire:model="description" rows="4" class="wizard-input" placeholder="Describe the car — service history, condition, extras..."></textarea>
        </div>

        {{-- Features --}}
        @if($features->count())
        <div class="col-12">
            <label class="form-label-sm" style="margin-bottom:12px;display:block;">Features & Extras</label>
            @foreach($features as $category => $categoryFeatures)
                <div style="margin-bottom:16px;">
                    <div style="font-size:12px;font-weight:700;color:var(--color-main);text-transform:uppercase;letter-spacing:0.5px;margin-bottom:8px;">
                        {{ ucfirst($category) }}
                    </div>
                    <div style="display:flex;flex-wrap:wrap;gap:8px;">
                        @foreach($categoryFeatures as $feature)
                        <label style="display:flex;align-items:center;gap:6px;padding:6px 12px;border:1.5px solid #e2e8f0;border-radius:20px;cursor:pointer;font-size:13px;transition:all 0.15s;
                            {{ in_array($feature->id, $selected_features) ? 'background:var(--color-main);border-color:var(--color-main);color:#fff;' : 'background:#fff;' }}">
                            <input wire:model="selected_features" type="checkbox" value="{{ $feature->id }}" style="display:none;">
                            {{ $feature->name }}
                        </label>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

{{-- ══════════════════════════════════════════════
     STEP 3 — Plan & Payment
══════════════════════════════════════════════ --}}
@elseif($step === 3)
<div class="wizard-step">
    <h5 style="color:var(--primary);margin-bottom:8px;">Choose Your Listing Plan</h5>

    @if($user->hasActiveSubscription())
        <div style="background:#dcfce7;border:1px solid #86efac;border-radius:10px;padding:16px;margin-bottom:24px;">
            <p style="color:#15803d;font-weight:600;margin:0;">
                ✓ You have an active subscription — your listing will be submitted for review immediately after payment.
            </p>
        </div>
        {{-- Still ask which plan type to pick for the vehicle record --}}
    @else
        <p style="color:var(--color-text);margin-bottom:20px;font-size:14px;">
            Choose a plan to publish your listing. You'll be prompted to pay via M-Pesa after submitting.
        </p>
    @endif

    <div class="row">
        @foreach($plans as $plan)
        <div class="col-md-6 col-lg-4 mb-16">
            <div wire:click="selectPlan({{ $plan->id }})"
                 style="border:2px solid {{ $selected_plan_id == $plan->id ? 'var(--color-main)' : '#e2e8f0' }};
                        border-radius:12px;padding:20px;cursor:pointer;transition:all 0.2s;
                        background:{{ $selected_plan_id == $plan->id ? '#f0f4ff' : '#fff' }};">
                <div style="font-weight:700;font-size:15px;color:var(--primary);margin-bottom:4px;">{{ $plan->name }}</div>
                <div style="font-size:22px;font-weight:800;color:var(--color-main);margin-bottom:8px;">
                    @if($plan->max_listings == 1)
                        KES {{ number_format($plan->price_monthly) }}
                        <span style="font-size:13px;color:var(--color-text);font-weight:400;">/ listing</span>
                    @else
                        KES {{ number_format($plan->price_monthly) }}
                        <span style="font-size:13px;color:var(--color-text);font-weight:400;">/ month</span>
                    @endif
                </div>
                <ul style="list-style:none;padding:0;margin:0;font-size:13px;color:var(--color-text);">
                    <li>✓ {{ $plan->isUnlimited() ? 'Unlimited listings' : $plan->max_listings . ' listings' }}</li>
                    @if($plan->has_verified_badge)<li>✓ Verified badge</li>@endif
                    @if($plan->has_featured_placement)<li>✓ Featured placement</li>@endif
                    @if($plan->has_auto_score)<li>✓ AutoScore™ enabled</li>@endif
                </ul>
            </div>
        </div>
        @endforeach
    </div>
    @error('selected_plan_id') <span class="field-error">{{ $message }}</span> @enderror

    @if($selected_plan_id)
    <div style="background:#f8faff;border:1.5px solid #c7d2fe;border-radius:10px;padding:16px;margin-top:8px;">
        <p style="font-size:13px;color:var(--primary);margin:0;">
            <strong>Payment via M-Pesa:</strong> After submitting, you'll receive an STK push on your registered phone. Complete the payment to activate your listing.
        </p>
    </div>
    @endif
</div>

{{-- ══════════════════════════════════════════════
     STEP 4 — Review & Submit
══════════════════════════════════════════════ --}}
@elseif($step === 4)
<div class="wizard-step">
    <h5 style="color:var(--primary);margin-bottom:20px;">Review Your Listing</h5>

    <div style="background:#f8faff;border-radius:12px;padding:24px;margin-bottom:20px;">
        <h6 style="color:var(--primary);margin-bottom:12px;">{{ $title ?? 'Untitled' }}</h6>
        <div class="row" style="font-size:13px;color:var(--color-text);">
            <div class="col-6 col-md-3 mb-8"><strong>Year:</strong> {{ $year }}</div>
            <div class="col-6 col-md-3 mb-8"><strong>Condition:</strong> {{ str_replace('_', ' ', ucfirst($condition)) }}</div>
            <div class="col-6 col-md-3 mb-8"><strong>Mileage:</strong> {{ number_format($mileage) }} km</div>
            <div class="col-6 col-md-3 mb-8"><strong>Transmission:</strong> {{ ucfirst($transmission) }}</div>
            <div class="col-6 col-md-3 mb-8"><strong>Fuel:</strong> {{ ucfirst($fuel_type) }}</div>
            <div class="col-6 col-md-3 mb-8"><strong>Price:</strong> KES {{ number_format($price) }}</div>
            <div class="col-6 col-md-3 mb-8"><strong>Location:</strong> {{ $county ?? '—' }}</div>
            <div class="col-6 col-md-3 mb-8"><strong>Availability:</strong> {{ $availability === 'import' ? 'Import' : 'In Kenya' }}</div>
        </div>

        @if($description)
        <div style="margin-top:12px;padding-top:12px;border-top:1px solid #e2e8f0;">
            <strong style="font-size:13px;">Description:</strong>
            <p style="font-size:13px;margin-top:4px;">{{ Str::limit($description, 200) }}</p>
        </div>
        @endif
    </div>

    <div style="background:#fff3cd;border:1px solid #ffc107;border-radius:8px;padding:14px;margin-bottom:20px;">
        <p style="font-size:13px;margin:0;color:#856404;">
            <strong>Next:</strong> After submitting, our team will review your listing within 24 hours.
            @if(!$user->hasActiveSubscription()) You will receive an M-Pesa payment prompt to complete the process. @endif
        </p>
    </div>

    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
        <button wire:click="prevStep" type="button" class="btn-prev">← Back</button>
        <button wire:click="submit" type="button" class="sc-button" style="justify-content:center;padding:14px 32px;"
                wire:loading.attr="disabled">
            <span wire:loading.remove>Submit Listing</span>
            <span wire:loading>Submitting…</span>
        </button>
    </div>
</div>
@endif

{{-- ══════════════════════════════════════════════
     NAVIGATION BUTTONS (Steps 1-3)
══════════════════════════════════════════════ --}}
@if($step < 4)
<div style="display:flex;justify-content:space-between;margin-top:24px;flex-wrap:wrap;gap:12px;">
    @if($step > 1)
        <button wire:click="prevStep" type="button" class="btn-prev">← Back</button>
    @else
        <div></div>
    @endif

    <button wire:click="nextStep" type="button" class="sc-button" style="justify-content:center;padding:12px 28px;"
            wire:loading.attr="disabled">
        <span wire:loading.remove>{{ $step === 3 ? 'Review Listing →' : 'Continue →' }}</span>
        <span wire:loading>Please wait…</span>
    </button>
</div>
@endif

@endif
</div>
