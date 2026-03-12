@extends('layouts.app')

@section('title', 'Browse Cars — AutoVault Kenya')

@section('content')

{{-- ── Page Header ── --}}
<div class="av-page-header">
    <div class="container">
        <nav class="av-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" wire:navigate>Home</a>
            <span class="av-breadcrumb__sep">›</span>
            <span>Browse Cars</span>
        </nav>
        <h1 class="av-page-header__title">Browse Cars in Kenya</h1>
    </div>
</div>

{{-- ── Search Filter ── --}}
<div class="av-listing-search">
    <div class="container">
        @livewire('search-filter')
    </div>
</div>

{{-- ── Listing Grid ── --}}
<section class="tf-section">
    <div class="container">
        @livewire('vehicle-listing')
    </div>
</section>

@endsection
