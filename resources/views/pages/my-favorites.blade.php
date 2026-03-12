@extends('layouts.dashboard')
@section('title', 'My Favourites')

@section('dashboard-content')

<h1 class="admin-title">My Favourites</h1>

<div class="tfcl-favorite-listing">

    <div class="controller-sorting mb-3">
        <div class="count-list">
            <span>{{ $saved->total() }}</span> saved car{{ $saved->total() !== 1 ? 's' : '' }}
        </div>
        <div>
            <a href="{{ route('cars.index') }}" class="sc-button style-1" style="padding:8px 18px;font-size:13px;">
                <span>Browse More Cars</span>
            </a>
        </div>
    </div>

    @if($saved->isEmpty())
        <div style="text-align:center;padding:60px 20px;background:#f8faff;border-radius:16px;border:2px dashed #c7d2fe;">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" style="margin-bottom:16px;">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h5 style="color:var(--primary);margin-bottom:8px;">No saved cars yet</h5>
            <p style="color:#64748b;margin-bottom:20px;">Tap the heart icon on any listing to save it here for later.</p>
            <a href="{{ route('cars.index') }}" class="sc-button" style="justify-content:center;">Browse Cars</a>
        </div>
    @else
        <div class="wrap-favorite-listing">
            @foreach($saved as $vehicle)
            <div class="box-car-list hv-one" style="position:relative;">
                <div class="image-group relative">
                    <div class="top flex-two">
                        <ul class="d-flex gap-8">
                            @if($vehicle->is_featured)
                                <li class="flag-tag success">Featured</li>
                            @endif
                            @if($vehicle->is_verified)
                                <li class="flag-tag" style="background:#1d4ed8;">Verified</li>
                            @endif
                        </ul>
                        <div class="year flag-tag">{{ $vehicle->year }}</div>
                    </div>
                    <div class="img-style">
                        <img loading="lazy"
                             src="{{ $vehicle->cover_image_url ?? asset('assets/images/slider/slide3.jpg') }}"
                             alt="{{ $vehicle->title }}">
                    </div>
                    {{-- Remove from favourites --}}
                    <form method="POST" action="{{ route('my-favorites.toggle', $vehicle) }}" style="position:absolute;top:46px;right:8px;">
                        @csrf
                        <button type="submit" title="Remove from favourites"
                            style="background:#fee2e2;border:none;padding:0;width:34px;height:34px;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 1px 4px rgba(0,0,0,0.15);">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="#dc2626" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                            </svg>
                        </button>
                    </form>
                </div>
                <div class="content">
                    <div class="text-address">
                        <p class="text-color-3 font">{{ $vehicle->bodyType?->name ?? ucfirst(str_replace('_', ' ', $vehicle->condition)) }}</p>
                    </div>
                    <h5 class="link-style-1">
                        <a href="{{ route('cars.show', $vehicle) }}" wire:navigate>{{ Str::limit($vehicle->title, 45) }}</a>
                    </h5>
                    <div class="icon-box flex flex-wrap">
                        <div class="icons flex-three">
                            <i class="icon-autodeal-km1"></i>
                            <span>{{ $vehicle->formatted_mileage }}</span>
                        </div>
                        <div class="icons flex-three">
                            <i class="icon-autodeal-diesel"></i>
                            <span>{{ ucfirst($vehicle->fuel_type) }}</span>
                        </div>
                        <div class="icons flex-three">
                            <i class="icon-autodeal-automatic"></i>
                            <span>{{ ucfirst($vehicle->transmission) }}</span>
                        </div>
                    </div>
                    <div class="money fs-20 fw-5 lh-25 text-color-3">{{ $vehicle->formatted_price }}</div>
                    <div class="days-box flex justify-space align-center">
                        <div class="img-author">
                            <span class="font text-color-2 fw-5">{{ $vehicle->county ?? 'Kenya' }}</span>
                        </div>
                        <a href="{{ route('cars.show', $vehicle) }}" wire:navigate class="view-car">View car</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-24">
            {{ $saved->links() }}
        </div>
    @endif

</div>

@endsection
