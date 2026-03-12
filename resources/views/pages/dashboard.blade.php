@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('dashboard-content')

<h1 class="admin-title">Dashboard</h1>

{{-- ── Overview Cards ── --}}
<div class="tfcl-dashboard-overview">
    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <a class="tfcl-card" href="{{ route('my-listings.index') }}">
                <div class="card-body">
                    <div class="tfcl-icon-overview">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="40" height="40" rx="10" fill="#EEF2FF"/>
                            <path d="M28 14H12C10.9 14 10 14.9 10 16v14c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V16c0-1.1-.9-2-2-2zm0 16H12V18h16v12zm-10-3h-3v-3h3v3zm4 0h-3v-3h3v3zm4 0h-3v-3h3v3zm-8-4h-3v-3h3v3zm4 0h-3v-3h3v3zm4 0h-3v-3h3v3zm-8-7h-3v-3h3v3zm4 0h-3v-3h3v3zm4 0h-3v-3h3v3z" fill="#4F46E5"/>
                        </svg>
                    </div>
                    <div class="content-overview">
                        <h5>Total Listings</h5>
                        <div class="tfcl-dashboard-title">
                            <div class="listing-text d-flex">
                                <b>{{ $stats['total'] }}</b>
                                <div class="per">&nbsp;({{ $stats['active'] }} active)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xl-3">
            <a class="tfcl-card" href="{{ route('my-listings.index') }}">
                <div class="card-body">
                    <div class="tfcl-icon-overview">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="40" height="40" rx="10" fill="#FEF9C3"/>
                            <path d="M20 10C14.48 10 10 14.48 10 20s4.48 10 10 10 10-4.48 10-10S25.52 10 20 10zm1 5v5l4.25 2.52-.77 1.28L19 21v-6h2z" fill="#CA8A04"/>
                        </svg>
                    </div>
                    <div class="content-overview">
                        <h5>Pending Review</h5>
                        <div class="tfcl-dashboard-title">
                            <span><b>{{ $stats['pending'] }}</b></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xl-3">
            <a class="tfcl-card" href="{{ route('my-listings.index') }}">
                <div class="card-body">
                    <div class="tfcl-icon-overview">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="40" height="40" rx="10" fill="#DCFCE7"/>
                            <path d="M20 10C14.48 10 10 14.48 10 20s4.48 10 10 10 10-4.48 10-10S25.52 10 20 10zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S24.33 16 23.5 16s-1.5.67-1.5 1.5.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S17.33 16 16.5 16s-1.5.67-1.5 1.5.67 1.5 1.5 1.5zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H14.89c.8 2.04 2.78 3.5 5.11 3.5z" fill="#16A34A"/>
                        </svg>
                    </div>
                    <div class="content-overview">
                        <h5>Total Enquiries</h5>
                        <div class="tfcl-dashboard-title">
                            <span><b>{{ number_format($stats['enquiries']) }}</b></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xl-3">
            <a class="tfcl-card" href="{{ route('my-favorites') }}">
                <div class="card-body">
                    <div class="tfcl-icon-overview">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="40" height="40" rx="10" fill="#FEE2E2"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.17 16.31C10.18 13.24 11.33 9.73 14.55 8.69c1.7-.55 3.57-.23 4.98.83 1.33-.97 3.27-1.32 4.97-.77 3.22 1.04 4.38 4.55 3.39 7.62-1.53 4.87-8.36 8.62-8.36 8.62s-6.78-3.69-8.36-8.68zm8.83 4.69 5.78-5.77a3.5 3.5 0 00-4.95 0l-.83.84-.83-.84a3.5 3.5 0 00-4.95 4.95l5.78 5.78z" fill="#DC2626"/>
                        </svg>
                    </div>
                    <div class="content-overview">
                        <h5>Saved Cars</h5>
                        <div class="tfcl-dashboard-title">
                            <span><b>{{ $stats['saved'] }}</b></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

{{-- ── Secondary Stats ── --}}
<div class="row mt-20 mb-20">
    <div class="col-md-4">
        <div style="background:#f8fafc;border-radius:12px;padding:20px;text-align:center;border:1px solid #e2e8f0;">
            <div style="font-size:32px;font-weight:800;color:var(--color-main);">{{ number_format($stats['views']) }}</div>
            <div style="font-size:13px;color:#64748b;margin-top:4px;">Total Listing Views</div>
        </div>
    </div>
    <div class="col-md-4">
        <div style="background:#f8fafc;border-radius:12px;padding:20px;text-align:center;border:1px solid #e2e8f0;">
            <div style="font-size:32px;font-weight:800;color:#1d4ed8;">{{ $stats['active'] }}</div>
            <div style="font-size:13px;color:#64748b;margin-top:4px;">Active Listings</div>
        </div>
    </div>
    <div class="col-md-4">
        <div style="background:#f8fafc;border-radius:12px;padding:20px;text-align:center;border:1px solid #e2e8f0;">
            <div style="font-size:32px;font-weight:800;color:#7c3aed;">{{ $stats['saved'] }}</div>
            <div style="font-size:13px;color:#64748b;margin-top:4px;">Cars You Saved</div>
        </div>
    </div>
</div>

{{-- ── Recent Listings ── --}}
<div class="tfcl-dashboard-middle mt-20">
    <div class="tfcl-dashboard-listing">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
            <h5 class="title-dashboard-table" style="margin:0;">Recent Listings</h5>
            <a href="{{ route('my-listings.index') }}" style="font-size:13px;color:var(--color-main);font-weight:600;">View all</a>
        </div>

        @if($recentListings->isEmpty())
            <div style="text-align:center;padding:40px;background:#f8faff;border-radius:12px;border:2px dashed #c7d2fe;">
                <p style="color:#64748b;margin-bottom:16px;">You have no listings yet. Start selling!</p>
                <a href="{{ route('my-listings.create') }}" class="sc-button"><span>List Your First Car</span></a>
            </div>
        @else
            <div class="tfcl-table-listing">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Listing</th>
                                <th>Status</th>
                                <th>Views</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tfcl-table-content">
                            @foreach($recentListings as $listing)
                            @php
                                $statusMap = [
                                    'active'          => ['status-publish', 'Active'],
                                    'pending_review'  => ['status-pending', 'Pending Review'],
                                    'pending_payment' => ['status-pending', 'Pending Payment'],
                                    'draft'           => ['status-draft', 'Draft'],
                                    'rejected'        => ['status-rejected', 'Rejected'],
                                    'sold'            => ['status-sold', 'Sold'],
                                    'expired'         => ['status-draft', 'Expired'],
                                    'paused'          => ['status-draft', 'Paused'],
                                ];
                                [$cls, $label] = $statusMap[$listing->status] ?? ['status-draft', ucfirst($listing->status)];
                            @endphp
                            <tr>
                                <td class="column-listing">
                                    <div class="tfcl-listing-product">
                                        @if($listing->cover_image_url)
                                            <a href="{{ route('my-listings.show', $listing->id) }}">
                                                <img src="{{ $listing->cover_image_url }}" alt="{{ $listing->title }}" style="width:80px;height:56px;object-fit:cover;border-radius:6px;">
                                            </a>
                                        @endif
                                        <div class="tfcl-listing-summary">
                                            <h4 class="tfcl-listing-title">
                                                <a href="{{ route('my-listings.show', $listing->id) }}">{{ $listing->title }}</a>
                                            </h4>
                                            <div class="features-text">{{ $listing->brand->name ?? '' }} · {{ $listing->year }} · {{ ucfirst($listing->transmission) }}</div>
                                            <div class="price"><div class="inner tfcl-listing-price">KES {{ number_format($listing->price) }}</div></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="column-status">
                                    <span class="tfcl-listing-status {{ $cls }}">{{ $label }}</span>
                                </td>
                                <td class="column-date">
                                    <div class="tfcl-listing-date">{{ number_format($listing->views_count) }}</div>
                                </td>
                                <td class="column-date">
                                    <div class="tfcl-listing-date">{{ $listing->created_at->format('d M Y') }}</div>
                                </td>
                                <td class="column-controller">
                                    <div class="inner-controller">
                                        <a href="{{ route('my-listings.show', $listing->id) }}" class="btn-action tfcl-dashboard-action-edit">Details</a>
                                    </div>
                                    @if($listing->status === 'active')
                                    <div class="inner-controller">
                                        <a href="{{ route('cars.show', $listing->slug) }}" class="btn-action tfcl-dashboard-action-edit" target="_blank">View</a>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- ── Saved Cars Preview ── --}}
@if($recentSaved->isNotEmpty())
<div class="tfcl-dashboard-middle mt-30">
    <div class="tfcl-favorite-listing">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
            <h5 class="title-dashboard-table" style="margin:0;">Recently Saved Cars</h5>
            <a href="{{ route('my-favorites') }}" style="font-size:13px;color:var(--color-main);font-weight:600;">View all</a>
        </div>
        <div class="row">
            @foreach($recentSaved as $saved)
            <div class="col-lg-3 col-sm-6 mb-20">
                <x-vehicle-card :vehicle="$saved" />
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

{{-- ── Quick Actions ── --}}
<div class="mt-30 mb-30">
    <h5 class="title-dashboard-table mb-16">Quick Actions</h5>
    <div class="row g-12">
        <div class="col-6 col-md-3">
            <a href="{{ route('my-listings.create') }}" class="sc-button" style="width:100%;justify-content:center;padding:12px 16px;">
                <svg width="16" height="16" viewBox="0 0 18 18" fill="none"><path d="M9 1v16M1 9h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                <span>List a Car</span>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="{{ route('cars.index') }}" class="sc-button style-1" style="width:100%;justify-content:center;padding:12px 16px;">
                <span>Browse Cars</span>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="{{ route('compare') }}" class="sc-button style-1" style="width:100%;justify-content:center;padding:12px 16px;">
                <span>Compare Cars</span>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="{{ route('pricing') }}" class="sc-button style-1" style="width:100%;justify-content:center;padding:12px 16px;">
                <span>Upgrade Plan</span>
            </a>
        </div>
    </div>
</div>

@endsection
