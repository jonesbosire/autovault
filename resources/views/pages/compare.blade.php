@extends('layouts.app')
@section('title', 'Compare Cars')

@section('content')

<section class="flat-title">
    <div class="container2">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-inner style">
                    <div class="title-group fs-12">
                        <a class="home fw-6 text-color-3" href="{{ route('home') }}" wire:navigate>Home</a>
                        <span>Compare Cars</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="flat-property">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-heading flex-two flex-wrap">
                    <h1 class="heading-listing">Compare Cars</h1>
                    @if($vehicles->isNotEmpty())
                    <div>
                        <form method="POST" action="{{ route('compare.clear') }}">
                            @csrf
                            <button type="submit" style="background:#fee2e2;color:#dc2626;border:1.5px solid #fca5a5;padding:8px 18px;border-radius:6px;font-size:13px;font-weight:600;cursor:pointer;">
                                Clear All
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<section class="flat-section">
    <div class="container">

        @if($vehicles->isEmpty())
            {{-- Empty State --}}
            <div style="text-align:center;padding:80px 20px;background:#f8faff;border-radius:16px;border:2px dashed #c7d2fe;margin-bottom:40px;">
                <svg width="80" height="60" viewBox="0 0 80 60" fill="none" style="margin-bottom:20px;">
                    <rect x="5" y="15" width="30" height="40" rx="4" fill="#e2e8f0"/>
                    <rect x="45" y="15" width="30" height="40" rx="4" fill="#e2e8f0"/>
                    <path d="M20 35h40" stroke="#94a3b8" stroke-width="2" stroke-dasharray="4 2"/>
                </svg>
                <h4 style="color:var(--primary);margin-bottom:12px;">No cars to compare yet</h4>
                <p style="color:#64748b;max-width:420px;margin:0 auto 24px;">Browse cars and click the compare button on any listing to add it here. You can compare up to 3 cars side-by-side.</p>
                <a href="{{ route('cars.index') }}" class="sc-button" style="justify-content:center;">Browse Listings</a>
            </div>
        @else
            {{-- Car Cards Row --}}
            <div class="tf-compare-header" style="display:grid;grid-template-columns:repeat({{ $vehicles->count() }}, 1fr);gap:20px;margin-bottom:32px;">
                @foreach($vehicles as $vehicle)
                <div class="box-car-list hv-one" style="position:relative;">
                    <div class="image-group relative">
                        <div class="top flex-two">
                            <ul class="d-flex gap-8">
                                @if($vehicle->is_verified)<li class="flag-tag" style="background:#1d4ed8;">Verified</li>@endif
                                @if($vehicle->is_featured)<li class="flag-tag success">Featured</li>@endif
                            </ul>
                            <div class="year flag-tag">{{ $vehicle->year }}</div>
                        </div>
                        <div class="img-style">
                            <img loading="lazy"
                                 src="{{ $vehicle->cover_image_url ?? asset('assets/images/slider/slide3.jpg') }}"
                                 alt="{{ $vehicle->title }}">
                        </div>
                    </div>
                    <div class="content">
                        <div class="text-address">
                            <p class="text-color-3 font">{{ $vehicle->bodyType?->name ?? ucfirst($vehicle->condition) }}</p>
                        </div>
                        <h5 class="link-style-1 mb-3">
                            <a href="{{ route('cars.show', $vehicle) }}" wire:navigate>{{ $vehicle->title }}</a>
                        </h5>
                        <div class="money fs-20 fw-5 lh-25 text-color-3">{{ $vehicle->formatted_price }}</div>
                        {{-- Autoscore --}}
                        @if($vehicle->auto_score)
                        @php $cls = $vehicle->auto_score >= 90 ? 'excellent' : ($vehicle->auto_score >= 70 ? 'good' : ($vehicle->auto_score >= 50 ? 'fair' : 'poor')); @endphp
                        <div class="mt-8">
                            <span class="autoscore-badge {{ $cls }}" style="font-size:11px;padding:3px 10px;">AutoScore™ {{ $vehicle->auto_score }}/100</span>
                        </div>
                        @endif
                    </div>
                    {{-- Remove button --}}
                    <form method="POST" action="{{ route('compare.remove', $vehicle) }}" style="position:absolute;top:8px;right:8px;">
                        @csrf
                        <button type="submit" title="Remove from compare"
                            style="background:rgba(255,255,255,0.9);border:none;width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 1px 3px rgba(0,0,0,0.2);">
                            <svg width="12" height="12" viewBox="0 0 14 14" fill="none">
                                <path d="M1 1l12 12M13 1L1 13" stroke="#64748b" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </button>
                    </form>
                </div>
                @endforeach

                {{-- Add Car Slot --}}
                @if($vehicles->count() < 3)
                <div style="border:2px dashed #c7d2fe;border-radius:12px;min-height:250px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:12px;padding:24px;text-align:center;">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                        <circle cx="20" cy="20" r="19" stroke="#c7d2fe" stroke-width="2"/>
                        <path d="M20 12v16M12 20h16" stroke="#818cf8" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <p style="color:#64748b;font-size:13px;margin:0;">Add another car</p>
                    <a href="{{ route('cars.index') }}" class="sc-button style-1" style="padding:8px 18px;font-size:13px;">
                        <span>Browse Cars</span>
                    </a>
                </div>
                @endif
            </div>

            {{-- Scrollspy Tabs --}}
            <nav id="navbar-example2" class="navbar tab-listing-scroll mb-30">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#overview">Overview</a></li>
                    <li class="nav-item"><a class="nav-link" href="#specs">Specifications</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                </ul>
            </nav>

            @php
                $colStyle = 'grid-template-columns: repeat(' . $vehicles->count() . ', 1fr)';
            @endphp

            {{-- Overview Table --}}
            <div id="overview">
                <div class="tf-compare-overview compare-table">
                    <h3 class="title-table">Car Overview</h3>

                    @php
                        $rows = [
                            'Price'        => fn($v) => $v->formatted_price,
                            'Year'         => fn($v) => $v->year,
                            'Condition'    => fn($v) => ucfirst(str_replace('_', ' ', $v->condition)),
                            'Body Type'    => fn($v) => $v->bodyType?->name ?? '—',
                            'Mileage'      => fn($v) => $v->formatted_mileage,
                            'Fuel Type'    => fn($v) => ucfirst($v->fuel_type),
                            'Transmission' => fn($v) => ucfirst($v->transmission),
                            'Drive Type'   => fn($v) => strtoupper($v->drive_type ?? '—'),
                            'Engine'       => fn($v) => $v->engine_cc ? $v->engine_cc . 'cc' : '—',
                            'Color'        => fn($v) => ucfirst($v->color ?? '—'),
                            'Doors'        => fn($v) => $v->doors . ' Doors',
                            'Seats'        => fn($v) => $v->seats . ' Seats',
                            'Location'     => fn($v) => $v->location_text ?? $v->county ?? 'Kenya',
                            'AutoScore™'   => fn($v) => $v->auto_score ? $v->auto_score . '/100' : 'Not rated',
                        ];
                    @endphp

                    @foreach($rows as $label => $getter)
                    <div class="title-tr">{{ $label }}</div>
                    <ul class="group-tr" style="{{ $colStyle }}">
                        @foreach($vehicles as $vehicle)
                        <li>{{ $getter($vehicle) }}</li>
                        @endforeach
                    </ul>
                    @endforeach
                </div>
            </div>

            {{-- Specifications --}}
            <div id="specs" style="margin-top:32px;">
                <div class="tf-compare-overview compare-table">
                    <h3 class="title-table">Specifications</h3>

                    @php
                        $specRows = [
                            'Price (KES)'    => fn($v) => 'KES ' . number_format($v->price),
                            'Negotiable'     => fn($v) => $v->is_negotiable ? 'Yes' : 'No',
                            'Availability'   => fn($v) => ucfirst($v->availability),
                            'Import Country' => fn($v) => $v->import_country ?? '—',
                            'Verified'       => fn($v) => $v->is_verified ? '✓ Yes' : 'No',
                            'Featured'       => fn($v) => $v->is_featured ? '✓ Yes' : 'No',
                        ];
                    @endphp

                    @foreach($specRows as $label => $getter)
                    <div class="title-tr">{{ $label }}</div>
                    <ul class="group-tr" style="{{ $colStyle }}">
                        @foreach($vehicles as $vehicle)
                        <li>{{ $getter($vehicle) }}</li>
                        @endforeach
                    </ul>
                    @endforeach
                </div>
            </div>

            {{-- Features --}}
            @if($vehicles->every(fn($v) => $v->features->isNotEmpty()))
            <div id="features" style="margin-top:32px;">
                <div class="tf-compare-fatures compare-table">
                    <h3 class="title-table">Features</h3>
                    @php
                        $allFeatures = $vehicles->flatMap(fn($v) => $v->features)->unique('id')->sortBy('name');
                    @endphp
                    @foreach($allFeatures as $feature)
                    <div class="title-tr">{{ $feature->name }}</div>
                    <ul class="group-tr" style="{{ $colStyle }}">
                        @foreach($vehicles as $vehicle)
                        <li>
                            @if($vehicle->features->contains('id', $feature->id))
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="15" viewBox="0 0 18 15" fill="none">
                                    <path d="M1.5 8.25L7.5 14.25L16.5 0.75" stroke="#FF7101" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            @else
                                <span style="color:#94a3b8;">—</span>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- CTA Row --}}
            <div style="display:grid;grid-template-columns:repeat({{ $vehicles->count() }}, 1fr);gap:20px;margin-top:32px;">
                @foreach($vehicles as $vehicle)
                <div style="text-align:center;">
                    <a href="{{ $vehicle->whatsapp_link }}" target="_blank"
                       class="sc-button" style="width:100%;justify-content:center;margin-bottom:10px;">
                        <span>WhatsApp Seller</span>
                    </a>
                    <a href="{{ route('cars.show', $vehicle) }}" wire:navigate
                       class="sc-button style-1" style="width:100%;justify-content:center;">
                        <span>View Listing</span>
                    </a>
                </div>
                @endforeach
            </div>

        @endif

    </div>
</section>

@endsection
