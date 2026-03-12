@extends('layouts.dashboard')
@section('title', 'Listing — ' . $vehicle->title)

@section('dashboard-content')

{{-- Breadcrumb --}}
<div style="display:flex;align-items:center;gap:8px;font-size:13px;color:#64748b;margin-bottom:20px;flex-wrap:wrap;">
    <a href="{{ route('my-listings.index') }}" wire:navigate style="color:var(--color-main);font-weight:600;">My Listings</a>
    <span>/</span>
    <span>{{ Str::limit($vehicle->title, 50) }}</span>
</div>

{{-- Status Banner --}}
@php
    $statusConfig = [
        'active'          => ['bg'=>'#dcfce7','color'=>'#15803d','label'=>'Active — visible to buyers'],
        'pending_review'  => ['bg'=>'#fef9c3','color'=>'#854d0e','label'=>'Pending Review — our team is checking your listing'],
        'pending_payment' => ['bg'=>'#fee2e2','color'=>'#dc2626','label'=>'Payment Required — complete payment to go live'],
        'draft'           => ['bg'=>'#f1f5f9','color'=>'#64748b','label'=>'Draft — not published yet'],
        'rejected'        => ['bg'=>'#fee2e2','color'=>'#dc2626','label'=>'Rejected — see notes below'],
        'sold'            => ['bg'=>'#e0e7ff','color'=>'#4338ca','label'=>'Sold'],
        'expired'         => ['bg'=>'#f1f5f9','color'=>'#94a3b8','label'=>'Expired'],
    ];
    $sc = $statusConfig[$vehicle->status] ?? ['bg'=>'#f1f5f9','color'=>'#64748b','label'=>ucfirst($vehicle->status)];
@endphp
<div style="background:{{ $sc['bg'] }};border-left:4px solid {{ $sc['color'] }};padding:14px 20px;border-radius:8px;margin-bottom:24px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px;">
    <p style="font-size:14px;font-weight:600;color:{{ $sc['color'] }};margin:0;">
        Status: {{ $sc['label'] }}
    </p>
    @if($vehicle->status === 'active')
    <a href="{{ route('cars.show', $vehicle) }}" target="_blank" class="sc-button" style="font-size:12px;padding:8px 16px;">
        <span>View Public Listing</span>
    </a>
    @elseif($vehicle->status === 'pending_payment')
    <a href="{{ route('pricing') }}" wire:navigate class="sc-button" style="font-size:12px;padding:8px 16px;">
        <span>Complete Payment</span>
    </a>
    @endif
</div>

<div class="row">

    {{-- ── Main ── --}}
    <div class="col-lg-8">

        {{-- Image --}}
        <div style="border-radius:12px;overflow:hidden;margin-bottom:24px;">
            <img src="{{ $vehicle->cover_image_url ?? asset('assets/images/section/slider-listing1.jpg') }}"
                 alt="{{ $vehicle->title }}"
                 style="width:100%;height:280px;object-fit:cover;display:block;">
        </div>

        {{-- Title & Price --}}
        <div class="widget-listing mb-24" style="padding:24px;">
            <h2 style="font-size:22px;font-weight:700;margin-bottom:10px;">{{ $vehicle->title }}</h2>
            <div style="display:flex;flex-wrap:wrap;align-items:center;gap:12px;">
                <span style="font-size:26px;font-weight:800;color:var(--color-main);">{{ $vehicle->formatted_price }}</span>
                @if($vehicle->is_negotiable)
                    <span style="font-size:12px;color:#64748b;background:#f1f5f9;padding:3px 10px;border-radius:20px;">Negotiable</span>
                @endif
                @if($vehicle->auto_score)
                    @php $cls = $vehicle->auto_score >= 90 ? 'excellent' : ($vehicle->auto_score >= 70 ? 'good' : ($vehicle->auto_score >= 50 ? 'fair' : 'poor')); @endphp
                    <span class="autoscore-badge {{ $cls }}" style="font-size:12px;padding:4px 12px;">AutoScore™ {{ $vehicle->auto_score }}</span>
                @endif
            </div>
        </div>

        {{-- Overview Grid --}}
        <div class="widget-listing mb-24" style="padding:24px;">
            <div class="tfcl-listing-header mb-20">
                <h2>Listing Overview</h2>
            </div>
            <div class="row">
                <div class="col-md-6 col-xl-4 item mb-16">
                    <div class="inner listing-infor-box">
                        <div class="icon"><i class="icon-autodeal-calendar fs-20"></i></div>
                        <div class="content-listing-info">
                            <span class="listing-info-title">Year</span>
                            <p class="listing-info-value">{{ $vehicle->year }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4 item mb-16">
                    <div class="inner listing-infor-box">
                        <div class="icon"><i class="icon-autodeal-km1 fs-20"></i></div>
                        <div class="content-listing-info">
                            <span class="listing-info-title">Mileage</span>
                            <p class="listing-info-value">{{ $vehicle->formatted_mileage }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4 item mb-16">
                    <div class="inner listing-infor-box">
                        <div class="icon"><i class="icon-autodeal-gearbox fs-20"></i></div>
                        <div class="content-listing-info">
                            <span class="listing-info-title">Transmission</span>
                            <p class="listing-info-value">{{ ucfirst($vehicle->transmission) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4 item mb-16">
                    <div class="inner listing-infor-box">
                        <div class="icon"><i class="icon-autodeal-fuel fs-20"></i></div>
                        <div class="content-listing-info">
                            <span class="listing-info-title">Fuel Type</span>
                            <p class="listing-info-value">{{ ucfirst(str_replace('_',' ',$vehicle->fuel_type)) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4 item mb-16">
                    <div class="inner listing-infor-box">
                        <div class="icon"><i class="icon-autodeal-car fs-20"></i></div>
                        <div class="content-listing-info">
                            <span class="listing-info-title">Body Type</span>
                            <p class="listing-info-value">{{ $vehicle->bodyType?->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4 item mb-16">
                    <div class="inner listing-infor-box">
                        <div class="icon"><i class="icon-autodeal-map fs-20"></i></div>
                        <div class="content-listing-info">
                            <span class="listing-info-title">Location</span>
                            <p class="listing-info-value">{{ $vehicle->county ?? 'Kenya' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Description --}}
        @if($vehicle->description)
        <div class="widget-listing mb-24" style="padding:24px;">
            <div class="tfcl-listing-header mb-16">
                <h2>Description</h2>
            </div>
            <p class="texts">{!! nl2br(e($vehicle->description)) !!}</p>
        </div>
        @endif

        {{-- Enquiries --}}
        @if($vehicle->enquiries->isNotEmpty())
        <div class="widget-listing mb-24" style="padding:24px;">
            <div class="tfcl-listing-header mb-20">
                <h2>Enquiries ({{ $vehicle->enquiries->count() }})</h2>
            </div>
            @foreach($vehicle->enquiries->sortByDesc('created_at') as $enq)
            <div style="border:1px solid #e8ecf0;border-radius:10px;padding:16px;margin-bottom:12px;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;flex-wrap:wrap;gap:8px;">
                    <strong style="font-size:14px;">{{ $enq->name }}</strong>
                    <span style="font-size:12px;color:#64748b;">{{ $enq->created_at->diffForHumans() }}</span>
                </div>
                <p style="font-size:13px;color:#374151;margin:0 0 10px;">{{ $enq->message }}</p>
                <div style="display:flex;gap:12px;flex-wrap:wrap;">
                    @if($enq->phone)
                    <a href="tel:{{ $enq->phone }}" style="font-size:13px;color:var(--color-main);font-weight:600;">
                        <i class="icon-autodeal-phone2" style="margin-right:4px;"></i>{{ $enq->phone }}
                    </a>
                    @endif
                    @if($enq->email)
                    <a href="mailto:{{ $enq->email }}" style="font-size:13px;color:#64748b;">{{ $enq->email }}</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

    </div>

    {{-- ── Sidebar ── --}}
    <div class="col-lg-4">

        {{-- Performance Stats --}}
        <div class="widget-listing mb-24" style="padding:24px;">
            <div class="heading-widget mb-16">
                <h5 class="title" style="font-size:16px;">Listing Performance</h5>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:16px;">
                <div style="background:#f8faff;border-radius:10px;padding:16px;text-align:center;">
                    <div style="font-size:26px;font-weight:800;color:var(--color-main);">{{ number_format($vehicle->views_count) }}</div>
                    <div style="font-size:12px;color:#64748b;margin-top:2px;">Views</div>
                </div>
                <div style="background:#f8faff;border-radius:10px;padding:16px;text-align:center;">
                    <div style="font-size:26px;font-weight:800;color:var(--color-main);">{{ number_format($vehicle->enquiries_count) }}</div>
                    <div style="font-size:12px;color:#64748b;margin-top:2px;">Enquiries</div>
                </div>
            </div>
            <ul style="list-style:none;padding:0;margin:0;">
                <li style="display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px solid #f1f5f9;font-size:13px;">
                    <span style="color:#64748b;">Listed on</span>
                    <strong>{{ $vehicle->created_at->format('d M Y') }}</strong>
                </li>
                <li style="display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px solid #f1f5f9;font-size:13px;">
                    <span style="color:#64748b;">Expires</span>
                    <strong>{{ $vehicle->expires_at?->format('d M Y') ?? '—' }}</strong>
                </li>
                <li style="display:flex;justify-content:space-between;padding:10px 0;font-size:13px;">
                    <span style="color:#64748b;">Reference</span>
                    <strong>#{{ str_pad($vehicle->id, 5, '0', STR_PAD_LEFT) }}</strong>
                </li>
            </ul>
        </div>

        {{-- AutoScore --}}
        @if($vehicle->auto_score)
        <div class="widget-listing mb-24" style="padding:24px;text-align:center;">
            <div class="heading-widget mb-12">
                <h5 class="title" style="font-size:16px;">AutoScore™</h5>
            </div>
            @php $cls = $vehicle->auto_score >= 90 ? 'excellent' : ($vehicle->auto_score >= 70 ? 'good' : ($vehicle->auto_score >= 50 ? 'fair' : 'poor')); @endphp
            <span class="autoscore-badge {{ $cls }}" style="font-size:28px;padding:12px 28px;">
                {{ $vehicle->auto_score }}<span style="font-size:14px;">/100</span>
            </span>
            <p style="font-size:12px;color:#64748b;margin:10px 0 0;">Trust index by AutoVault</p>
        </div>
        @endif

        {{-- Features --}}
        @if($vehicle->features->isNotEmpty())
        <div class="widget-listing mb-24" style="padding:24px;">
            <div class="heading-widget mb-16">
                <h5 class="title" style="font-size:16px;">Features</h5>
            </div>
            <div style="display:flex;flex-wrap:wrap;gap:8px;">
                @foreach($vehicle->features as $feat)
                <span style="background:#f1f5f9;border-radius:20px;padding:4px 12px;font-size:12px;color:#374151;">{{ $feat->name }}</span>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Quick Actions --}}
        <div class="widget-listing mb-24" style="padding:24px;">
            <h5 style="font-size:15px;font-weight:700;margin-bottom:16px;">Actions</h5>
            <div style="display:flex;flex-direction:column;gap:10px;">
                @if($vehicle->status === 'active')
                <a href="{{ route('cars.show', $vehicle) }}" target="_blank"
                   class="sc-button" style="width:100%;justify-content:center;">
                    <span>View Public Listing</span>
                </a>
                @endif
                @if($vehicle->status === 'pending_payment')
                <a href="{{ route('pricing') }}" wire:navigate
                   class="sc-button" style="width:100%;justify-content:center;">
                    <span>Complete Payment</span>
                </a>
                @endif
                <a href="{{ route('my-listings.index') }}" wire:navigate
                   style="display:flex;align-items:center;justify-content:center;width:100%;padding:11px 20px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;font-weight:600;color:var(--primary);text-decoration:none;transition:all .2s;">
                    ← Back to My Listings
                </a>
            </div>
        </div>

    </div>
</div>

@endsection
