@extends('layouts.app')

@section('title', $vehicle->title . ' — KES ' . number_format($vehicle->price))
@section('meta_description', 'Buy ' . $vehicle->title . ' in Kenya. ' . ucfirst($vehicle->condition) . ', ' . $vehicle->year . ' model. KES ' . number_format($vehicle->price) . '. AutoVault Kenya.')

@section('content')

{{-- Breadcrumb --}}
<section class="flat-title mb-40">
    <div class="container2">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-inner style">
                    <div class="title-group fs-12">
                        <a class="home fw-6 text-color-3" href="{{ route('home') }}" wire:navigate>Home</a>
                        <a class="home fw-6 text-color-3" href="{{ route('cars.index') }}" wire:navigate>Cars for sale</a>
                        <span>{{ $vehicle->title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="tf-section3 listing-detail style-1">
    <div class="container">
        <div class="row">

            {{-- ── Main Column ────────────────────────────────────────── --}}
            <div class="col-lg-8">
                <div class="listing-detail-wrap">

                    {{-- ── Gallery Swiper ── --}}
                    @php $coverImg = $vehicle->cover_image_url ?? asset('assets/images/section/slider-listing1.jpg'); @endphp
                    <div dir="ltr" class="swiper mainslider slider home mb-40">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="image-list-details">
                                    <a class="image" href="{{ $coverImg }}" data-fancybox="gallery">
                                        <img loading="eager"
                                             src="{{ $coverImg }}"
                                             alt="{{ $vehicle->title }}">
                                    </a>
                                    <div class="specs-features-wrap flex-three">
                                        <a class="specs-features" href="{{ $coverImg }}" data-fancybox="gallery">
                                            <div class="icon">
                                                <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.875 10.125L5.17417 5.82583C5.34828 5.65172 5.55498 5.51361 5.78246 5.41938C6.00995 5.32515 6.25377 5.27665 6.5 5.27665C6.74623 5.27665 6.99005 5.32515 7.21754 5.41938C7.44502 5.51361 7.65172 5.65172 7.82583 5.82583L12.125 10.125M10.875 8.875L12.0492 7.70083C12.2233 7.52672 12.43 7.38861 12.6575 7.29438C12.885 7.20015 13.1288 7.15165 13.375 7.15165C13.6212 7.15165 13.865 7.20015 14.0925 7.29438C14.32 7.38861 14.5267 7.52672 14.7008 7.70083L17.125 10.125M2.125 13.25H15.875C16.2065 13.25 16.5245 13.1183 16.7589 12.8839C16.9933 12.6495 17.125 12.3315 17.125 12V2C17.125 1.66848 16.9933 1.35054 16.7589 1.11612C16.5245 0.881696 16.2065 0.75 15.875 0.75H2.125C1.79348 0.75 1.47554 0.881696 1.24112 1.11612C1.0067 1.35054 0.875 1.66848 0.875 2V12C0.875 12.3315 1.0067 12.6495 1.24112 12.8839C1.47554 13.1183 1.79348 13.25 2.125 13.25Z" stroke="CurrentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            </div>
                                            <span class="fw-5 font text-color-2 lh-16">View image</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-next style-3"></div>
                        <div class="swiper-button-prev style-3"></div>
                    </div>

                    {{-- ── Scrollspy Nav ── --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <nav id="navbar-example2" class="navbar tab-listing-scroll">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#scrollspyHeading1">Overview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#scrollspyHeading2">Specs &amp; features</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#scrollspyHeading3">Similar cars</a>
                                    </li>
                                </ul>
                            </nav>

                            <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example" tabindex="0">

                                {{-- ── Description ── --}}
                                @if($vehicle->description)
                                <div class="listing-description mb-40">
                                    <div class="tfcl-listing-header">
                                        <h2>Description</h2>
                                    </div>
                                    <div class="tfcl-listing-info mt-30">
                                        <p>{!! nl2br(e($vehicle->description)) !!}</p>
                                    </div>
                                </div>
                                @endif

                                {{-- ── Car Overview ── --}}
                                <div class="listing-description footer-col-block" id="scrollspyHeading1">
                                    <div class="footer-heading-desktop">
                                        <h2>Car overview</h2>
                                    </div>
                                    <div class="footer-heading-mobie listing-details-mobie">
                                        <h2>Car overview</h2>
                                    </div>
                                    <div class="tfcl-listing-info tf-collapse-content mt-30">
                                        <div class="row">

                                            <div class="col-xl-6 col-md-6 item">
                                                <div class="inner listing-infor-box">
                                                    <div class="icon">
                                                        <i class="icon-autodeal-calendar fs-20"></i>
                                                    </div>
                                                    <div class="content-listing-info">
                                                        <span class="listing-info-title">Year:</span>
                                                        <p class="listing-info-value">{{ $vehicle->year }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-md-6 item">
                                                <div class="inner listing-infor-box">
                                                    <div class="icon">
                                                        <i class="icon-autodeal-km1 fs-20"></i>
                                                    </div>
                                                    <div class="content-listing-info">
                                                        <span class="listing-info-title">Mileage:</span>
                                                        <p class="listing-info-value">{{ $vehicle->formatted_mileage }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-md-6 item">
                                                <div class="inner listing-infor-box">
                                                    <div class="icon">
                                                        <i class="icon-autodeal-gearbox fs-20"></i>
                                                    </div>
                                                    <div class="content-listing-info">
                                                        <span class="listing-info-title">Transmission:</span>
                                                        <p class="listing-info-value">{{ ucfirst($vehicle->transmission) }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-md-6 item">
                                                <div class="inner listing-infor-box">
                                                    <div class="icon">
                                                        <i class="icon-autodeal-fuel fs-20"></i>
                                                    </div>
                                                    <div class="content-listing-info">
                                                        <span class="listing-info-title">Fuel Type:</span>
                                                        <p class="listing-info-value">{{ ucfirst(str_replace('_', ' ', $vehicle->fuel_type)) }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-md-6 item">
                                                <div class="inner listing-infor-box">
                                                    <div class="icon">
                                                        <i class="icon-autodeal-car fs-20"></i>
                                                    </div>
                                                    <div class="content-listing-info">
                                                        <span class="listing-info-title">Body Type:</span>
                                                        <p class="listing-info-value">{{ $vehicle->bodyType?->name ?? 'N/A' }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-md-6 item">
                                                <div class="inner listing-infor-box">
                                                    <div class="icon">
                                                        <i class="icon-autodeal-check fs-20"></i>
                                                    </div>
                                                    <div class="content-listing-info">
                                                        <span class="listing-info-title">Condition:</span>
                                                        <p class="listing-info-value">{{ ucfirst(str_replace('_', ' ', $vehicle->condition)) }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            @if($vehicle->engine_cc)
                                            <div class="col-xl-6 col-md-6 item">
                                                <div class="inner listing-infor-box">
                                                    <div class="icon">
                                                        <i class="icon-autodeal-engine fs-20"></i>
                                                    </div>
                                                    <div class="content-listing-info">
                                                        <span class="listing-info-title">Engine:</span>
                                                        <p class="listing-info-value">{{ $vehicle->engine_cc }}cc</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if($vehicle->drive_type)
                                            <div class="col-xl-6 col-md-6 item">
                                                <div class="inner listing-infor-box">
                                                    <div class="icon">
                                                        <i class="icon-autodeal-automatic fs-20"></i>
                                                    </div>
                                                    <div class="content-listing-info">
                                                        <span class="listing-info-title">Drive Type:</span>
                                                        <p class="listing-info-value">{{ $vehicle->drive_type }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if($vehicle->color)
                                            <div class="col-xl-6 col-md-6 item">
                                                <div class="inner listing-infor-box">
                                                    <div class="icon">
                                                        <i class="icon-autodeal-color fs-20"></i>
                                                    </div>
                                                    <div class="content-listing-info">
                                                        <span class="listing-info-title">Color:</span>
                                                        <p class="listing-info-value">{{ $vehicle->color }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if($vehicle->doors)
                                            <div class="col-xl-6 col-md-6 item">
                                                <div class="inner listing-infor-box">
                                                    <div class="icon">
                                                        <i class="icon-autodeal-car fs-20"></i>
                                                    </div>
                                                    <div class="content-listing-info">
                                                        <span class="listing-info-title">Doors:</span>
                                                        <p class="listing-info-value">{{ $vehicle->doors }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if($vehicle->seats)
                                            <div class="col-xl-6 col-md-6 item">
                                                <div class="inner listing-infor-box">
                                                    <div class="icon">
                                                        <i class="icon-autodeal-seats fs-20"></i>
                                                    </div>
                                                    <div class="content-listing-info">
                                                        <span class="listing-info-title">Seats:</span>
                                                        <p class="listing-info-value">{{ $vehicle->seats }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if($vehicle->county)
                                            <div class="col-xl-6 col-md-6 item">
                                                <div class="inner listing-infor-box">
                                                    <div class="icon">
                                                        <i class="icon-autodeal-map fs-20"></i>
                                                    </div>
                                                    <div class="content-listing-info">
                                                        <span class="listing-info-title">Location:</span>
                                                        <p class="listing-info-value">{{ $vehicle->county }}, Kenya</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="listing-line"></div>

                                {{-- ── Features ── --}}
                                @if($vehicle->features->isNotEmpty())
                                <div class="listing-features footer-col-block" id="scrollspyHeading2">
                                    <div class="footer-heading-desktop mb-30">
                                        <h2>Features</h2>
                                    </div>
                                    <div class="footer-heading-mobie listing-details-mobie mb-30">
                                        <h2>Features</h2>
                                    </div>
                                    <div class="features-inner tf-collapse-content">
                                        <div class="inner">
                                            @foreach($vehicle->features->take(14) as $feat)
                                            <div class="listing-feature-wrap flex">
                                                <i class="icon-autodeal-check"></i>
                                                <p>{{ $feat->name }}</p>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- Feature categories as accordions --}}
                                    @php $grouped = $vehicle->features->groupBy('category'); @endphp
                                    @if($grouped->count() > 1)
                                    <div class="row mt-20">
                                        <div class="col-lg-12 flat-accordion">
                                            @foreach($grouped as $cat => $feats)
                                            <div class="flat-toggle style-1">
                                                <div class="toggle-title flex align-center">
                                                    <h5 class="fw-6">{{ ucfirst($cat ?: 'General') }}</h5>
                                                    <div class="btn-toggle"></div>
                                                </div>
                                                <div class="toggle-content section-desc">
                                                    <div class="inner" style="padding:10px 0;">
                                                        @foreach($feats as $feat)
                                                        <div class="listing-feature-wrap flex">
                                                            <i class="icon-autodeal-check"></i>
                                                            <p>{{ $feat->name }}</p>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="listing-line"></div>
                                @endif

                                {{-- ── AutoScore Breakdown ── --}}
                                @if($vehicle->auto_score)
                                <div class="listing-description mb-40">
                                    <div class="tfcl-listing-header">
                                        <h2>AutoScore™ Breakdown</h2>
                                    </div>
                                    <div class="tfcl-listing-info mt-30">
                                        <div class="flex justify-space align-center mb-16">
                                            <span style="font-size:15px;font-weight:600;">Overall Score</span>
                                            <span class="autoscore-badge {{ $vehicle->auto_score >= 90 ? 'excellent' : ($vehicle->auto_score >= 70 ? 'good' : ($vehicle->auto_score >= 50 ? 'fair' : 'poor')) }}" style="font-size:14px;padding:6px 16px;">{{ $vehicle->auto_score }}/100</span>
                                        </div>
                                        @php $breakdown = $vehicle->auto_score_breakdown ?? []; @endphp
                                        @foreach($breakdown as $key => $val)
                                        <div class="flex justify-space align-center mb-8">
                                            <span style="font-size:13px;color:#64748b;min-width:120px;">{{ ucwords(str_replace('_', ' ', $key)) }}</span>
                                            <div style="flex:1;margin:0 12px;height:6px;background:#e2e8f0;border-radius:3px;overflow:hidden;">
                                                <div style="height:100%;background:var(--color-main,#e53e3e);border-radius:3px;width:{{ $val }}%;"></div>
                                            </div>
                                            <span style="font-size:12px;font-weight:600;min-width:36px;text-align:right;">{{ $val }}%</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="listing-line"></div>
                                @endif

                                {{-- ── Similar Vehicles (Scrollspy anchor) ── --}}
                                @if($similar->isNotEmpty())
                                <div class="listing-description footer-col-block" id="scrollspyHeading3">
                                    <div class="footer-heading-desktop mb-30">
                                        <h2>Similar Cars</h2>
                                    </div>
                                    <div class="row g-24">
                                        @foreach($similar->take(4) as $s)
                                        <div class="col-md-6">
                                            <x-vehicle-card :vehicle="$s" />
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ── Sidebar ────────────────────────────────────────────── --}}
            <div class="col-lg-4">
                <div class="listing-sidebar">

                    {{-- Price + Actions widget --}}
                    <div class="widget-listing mb-40">
                        <div class="heading-widget">
                            <h2 class="title">{{ $vehicle->title }}</h2>
                            <div class="icon-box flex flex-wrap">
                                <div class="icons flex-three">
                                    <i class="icon-autodeal-km1"></i>
                                    <span>{{ $vehicle->formatted_mileage }}</span>
                                </div>
                                <div class="icons flex-three">
                                    <i class="icon-autodeal-fuel"></i>
                                    <span>{{ ucfirst(str_replace('_', ' ', $vehicle->fuel_type)) }}</span>
                                </div>
                                <div class="icons flex-three">
                                    <i class="icon-autodeal-gearbox"></i>
                                    <span>{{ ucfirst($vehicle->transmission) }}</span>
                                </div>
                                <div class="icons flex-three">
                                    <i class="icon-autodeal-calendar"></i>
                                    <span>{{ $vehicle->year }}</span>
                                </div>
                            </div>
                            <div class="money text-color-3 font">{{ $vehicle->formatted_price }}</div>
                            <div class="price-wrap">
                                @if($vehicle->is_negotiable)
                                <p class="fs-12 lh-16 text-color-2">Price is negotiable</p>
                                @endif
                                @if($vehicle->county)
                                <p class="fs-12 lh-16">
                                    <i class="icon-autodeal-map" style="margin-right:4px;"></i>{{ $vehicle->county }}, Kenya
                                </p>
                                @endif
                            </div>
                            <ul class="action-icon flex flex-wrap">
                                @if($vehicle->is_featured)
                                <li><span class="flag-tag success" style="font-size:12px;padding:4px 10px;">Featured</span></li>
                                @endif
                                @if($vehicle->is_verified)
                                <li><span class="flag-tag" style="background:#1d4ed8;color:#fff;font-size:12px;padding:4px 10px;">Verified</span></li>
                                @endif
                                @if($vehicle->auto_score)
                                @php $cls = $vehicle->auto_score >= 90 ? 'excellent' : ($vehicle->auto_score >= 70 ? 'good' : ($vehicle->auto_score >= 50 ? 'fair' : 'poor')); @endphp
                                <li><span class="autoscore-badge {{ $cls }}" style="font-size:12px;padding:4px 10px;">AutoScore™ {{ $vehicle->auto_score }}</span></li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    {{-- Seller / Contact widget --}}
                    <div class="widget-listing mb-30">
                        <div class="prolile-info flex-three mb-30">
                            <div class="image">
                                <img src="{{ asset('assets/images/author/avt1.jpg') }}" alt="{{ $vehicle->user?->name }}">
                            </div>
                            <div class="content">
                                <h4>{{ $vehicle->user?->name ?? 'AutoVault Seller' }}</h4>
                                @if($vehicle->is_verified)
                                <div class="verified flex-three">
                                    <div class="icon">
                                        <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 8.00024L6.5 9.50024L9 6.00024M7 1.30957C5.49049 2.74306 3.48018 3.52929 1.39867 3.50024C1.13389 4.30689 0.999317 5.15057 1 5.99957C1 9.72757 3.54934 12.8596 7 13.7482C10.4507 12.8602 13 9.72824 13 6.00024C13 5.1269 12.86 4.28624 12.6013 3.49957H12.5C10.3693 3.49957 8.43334 2.66757 7 1.30957Z" stroke="CurrentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </div>
                                    <span class="fs-12 fw-6 lh-16">Verified seller</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="profile-contact mb-20">
                            <h6>Contact seller</h6>
                            <div class="btn-contact flex-two">
                                <a href="{{ $vehicle->whats_app_link }}" target="_blank" rel="noopener" class="btn-pf bg-green">
                                    <i class="icon-autodeal-chat"></i>
                                    <span class="fs-16 fw-5 lh-20 font text-color-1">WhatsApp</span>
                                </a>
                                @if($vehicle->user?->phone)
                                <a href="tel:{{ $vehicle->user->phone }}" class="btn-pf bg-orange">
                                    <i class="icon-autodeal-phone2"></i>
                                    <span class="fs-16 fw-5 lh-20 font text-color-1">Call seller</span>
                                </a>
                                @endif
                            </div>
                        </div>

                        {{-- Enquiry Form --}}
                        @livewire('enquiry-form', ['vehicleId' => $vehicle->id])

                        {{-- Listing Details --}}
                        <div class="mt-20 pt-20" style="border-top:1px solid #f1f5f9;">
                            <ul style="list-style:none;padding:0;margin:0;">
                                <li style="display:flex;justify-content:space-between;padding:6px 0;border-bottom:1px solid #f8fafc;font-size:13px;">
                                    <span style="color:#64748b;">Listed</span>
                                    <span style="font-weight:600;">{{ $vehicle->approved_at?->diffForHumans() ?? 'Recently' }}</span>
                                </li>
                                <li style="display:flex;justify-content:space-between;padding:6px 0;border-bottom:1px solid #f8fafc;font-size:13px;">
                                    <span style="color:#64748b;">Views</span>
                                    <span style="font-weight:600;">{{ number_format($vehicle->views_count ?? 0) }}</span>
                                </li>
                                <li style="display:flex;justify-content:space-between;padding:6px 0;font-size:13px;">
                                    <span style="color:#64748b;">Reference</span>
                                    <span style="font-weight:600;">#{{ str_pad($vehicle->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- Safety Tips --}}
                    <div class="widget-listing mb-30" style="background:#fffbeb;border:1.5px solid #fde68a;">
                        <h6 style="font-size:13px;font-weight:700;color:#92400e;margin-bottom:10px;">Safety Tips</h6>
                        <ul style="list-style:none;padding:0;margin:0;">
                            <li class="listing-feature-wrap flex" style="margin-bottom:6px;">
                                <i class="icon-autodeal-check" style="color:#92400e;font-size:11px;margin-right:8px;margin-top:3px;"></i>
                                <p style="font-size:12px;color:#78350f;">Never pay before inspecting the vehicle</p>
                            </li>
                            <li class="listing-feature-wrap flex" style="margin-bottom:6px;">
                                <i class="icon-autodeal-check" style="color:#92400e;font-size:11px;margin-right:8px;margin-top:3px;"></i>
                                <p style="font-size:12px;color:#78350f;">Meet in a safe, public location</p>
                            </li>
                            <li class="listing-feature-wrap flex" style="margin-bottom:6px;">
                                <i class="icon-autodeal-check" style="color:#92400e;font-size:11px;margin-right:8px;margin-top:3px;"></i>
                                <p style="font-size:12px;color:#78350f;">Verify ownership documents (logbook)</p>
                            </li>
                            <li class="listing-feature-wrap flex">
                                <i class="icon-autodeal-check" style="color:#92400e;font-size:11px;margin-right:8px;margin-top:3px;"></i>
                                <p style="font-size:12px;color:#78350f;">Consider a pre-purchase inspection</p>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Accordion toggle (flat-toggle style-1)
    document.querySelectorAll('.flat-toggle.style-1 .toggle-title').forEach(function (title) {
        title.addEventListener('click', function () {
            var toggle = this.closest('.flat-toggle');
            var content = toggle.querySelector('.toggle-content');
            toggle.classList.toggle('active');
            if (content) {
                content.style.display = toggle.classList.contains('active') ? 'block' : 'none';
            }
        });
    });
    // Close all by default
    document.querySelectorAll('.flat-toggle.style-1 .toggle-content').forEach(function (c) {
        c.style.display = 'none';
    });
});
</script>
@endpush
