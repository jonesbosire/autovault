@extends('layouts.app')

@section('title', 'AutoVault — Kenya\'s Trusted Car Marketplace')

@section('content')

{{-- ── Static Hero ── --}}
<div class="av-hero-static">
    <div class="av-hero-static__bg" style="background-image:url('{{ asset('assets/images/slider/slide3.jpg') }}');"></div>
    <div class="av-hero-static__overlay"></div>
    <div class="container av-hero-static__content">
        <div class="text-center">
            <span class="av-hero-static__sub">
                {{ number_format($stats['total']) }}+ Verified Listings &nbsp;·&nbsp; AutoScore™ Rated &nbsp;·&nbsp; WhatsApp Direct
            </span>
            <h1 class="av-hero-static__title">Find Your Perfect Car in Kenya</h1>
        </div>
    </div>
</div>

{{-- ── Search Filter ── --}}
<div class="flat-filter-search home3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @livewire('search-filter')
            </div>
        </div>
    </div>
</div>

{{-- ── Popular Car Makes & Body Types ── --}}
<section class="tf-section bg-surface">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-section flex align-center justify-space flex-wrap gap-20" style="margin-bottom:40px;">
                    <h2 style="margin:0;">Popular Car Makes &amp; Body Types</h2>
                    <a href="{{ route('cars.index') }}" wire:navigate class="tf-btn-arrow">
                        View all<i class="icon-autodeal-btn-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-12">
                <div dir="ltr" class="swiper partner-slide overflow-hidden">
                    <div class="swiper-wrapper">
                        @foreach($bodyTypes as $type)
                        @php $img = ($loop->index % 8) + 1; @endphp
                        <div class="swiper-slide">
                            <a href="{{ route('cars.index', ['body_type' => $type->slug]) }}" wire:navigate class="partner-item style-3">
                                <div class="image">
                                    <img class="lazyload"
                                         data-src="{{ asset('assets/images/icon-box/car-list' . $img . '.png') }}"
                                         src="{{ asset('assets/images/icon-box/car-list' . $img . '.png') }}"
                                         alt="{{ $type->name }}">
                                </div>
                                <div class="content center">
                                    <div class="fs-16 fw-6 title text-color-2 font-2">{{ $type->name }}</div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── Featured Listings ── --}}
@if($featuredVehicles->isNotEmpty())
<section class="tf-section">
    <div class="container">
        <div class="heading-section flex align-center justify-space flex-wrap gap-20" style="margin-bottom:40px;">
            <div>
                <p class="text-subtitle text-color-3" style="margin-bottom:6px;">Handpicked for You</p>
                <h2 style="margin:0;">Featured Listings</h2>
            </div>
            <a href="{{ route('cars.index', ['featured' => 1]) }}" wire:navigate class="tf-btn-arrow">
                View All <i class="icon-autodeal-btn-right"></i>
            </a>
        </div>
        <div class="row gy-4">
            @foreach($featuredVehicles as $vehicle)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <x-vehicle-card :vehicle="$vehicle" />
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── Latest Cars ── --}}
@if($recentVehicles->isNotEmpty())
<section class="tf-section bg-surface">
    <div class="container">
        <div class="heading-section flex align-center justify-space flex-wrap gap-20" style="margin-bottom:40px;">
            <div>
                <p class="text-subtitle text-color-3" style="margin-bottom:6px;">Just Listed</p>
                <h2 style="margin:0;">Latest Cars</h2>
            </div>
            <a href="{{ route('cars.index') }}" wire:navigate class="tf-btn-arrow">
                Browse All <i class="icon-autodeal-btn-right"></i>
            </a>
        </div>
        <div class="row gy-4">
            @foreach($recentVehicles as $vehicle)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <x-vehicle-card :vehicle="$vehicle" />
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── Sell / Find Promo Boxes ── --}}
<section class="tf-section-banner">
    <div class="container">
        <div class="row g-24">
            <div class="col-lg-6">
                <div class="tf-image-box style2 bg-black flex-three">
                    <div class="image">
                        <img class="lazyload"
                             data-src="{{ asset('assets/images/img-box/find-car-4.png') }}"
                             src="{{ asset('assets/images/img-box/find-car-4.png') }}"
                             alt="List your car on AutoVault">
                    </div>
                    <div class="content">
                        <h2 class="text-color-1">List Your Car.<br>Reach Thousands.</h2>
                        <p class="text-color-1">Live in 24 hours. AutoScore™ rated. WhatsApp-direct enquiries.</p>
                        <a href="{{ route('my-listings.create') }}" wire:navigate class="find-cars">
                            <span>List Now</span>
                            <i class="icon-autodeal-next"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="tf-image-box style2 bg-orange flex-three">
                    <div class="image">
                        <img class="lazyload"
                             data-src="{{ asset('assets/images/img-box/find-car-4.png') }}"
                             src="{{ asset('assets/images/img-box/find-car-4.png') }}"
                             alt="Browse cars on AutoVault">
                    </div>
                    <div class="content">
                        <h2 class="text-color-1">Looking for a Car?</h2>
                        <p class="text-color-1">Thousands of verified listings filtered by make, price, year, and location.</p>
                        <a href="{{ route('cars.index') }}" wire:navigate class="find-cars">
                            <span>Browse Cars</span>
                            <i class="icon-autodeal-search"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
