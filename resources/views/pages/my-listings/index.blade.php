@extends('layouts.dashboard')
@section('title', 'My Listings')

@section('dashboard-content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;flex-wrap:wrap;gap:12px;">
    <h1 class="admin-title" style="margin:0;">My Listings</h1>
    <a href="{{ route('my-listings.create') }}" wire:navigate class="sc-button">
        <svg width="16" height="16" viewBox="0 0 18 18" fill="none"><path d="M9 1v16M1 9h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        <span>Add New Listing</span>
    </a>
</div>

@if($listings->isEmpty())
    <div style="text-align:center;padding:60px 20px;background:#f8faff;border-radius:16px;border:2px dashed #c7d2fe;">
        <div style="margin-bottom:16px;">
            <svg width="60" height="40" viewBox="0 0 60 40" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M55 15H50L43.75 5H16.25L10 15H5C3.625 15 2.5 16.125 2.5 17.5V30C2.5 30.688 3.063 31.25 3.75 31.25H6.25C6.25 34.012 8.488 36.25 11.25 36.25C14.012 36.25 16.25 34.012 16.25 31.25H43.75C43.75 34.012 45.988 36.25 48.75 36.25C51.512 36.25 53.75 34.012 53.75 31.25H56.25C56.938 31.25 57.5 30.688 57.5 30V17.5C57.5 16.125 56.375 15 55 15ZM11.25 33.75C9.875 33.75 8.75 32.625 8.75 31.25C8.75 29.875 9.875 28.75 11.25 28.75C12.625 28.75 13.75 29.875 13.75 31.25C13.75 32.625 12.625 33.75 11.25 33.75ZM48.75 33.75C47.375 33.75 46.25 32.625 46.25 31.25C46.25 29.875 47.375 28.75 48.75 28.75C50.125 28.75 51.25 29.875 51.25 31.25C51.25 32.625 50.125 33.75 48.75 33.75ZM12.5 20L17.5 10H42.5L47.5 20H12.5Z" fill="#CBD5E1"/></svg>
        </div>
        <h5 style="color:var(--primary);margin-bottom:8px;">No listings yet</h5>
        <p style="color:var(--color-text);margin-bottom:20px;">List your first car and reach thousands of buyers across Kenya</p>
        <a href="{{ route('my-listings.create') }}" wire:navigate class="sc-button" style="justify-content:center;">List Your First Car</a>
    </div>
@else
    <div class="tfcl-dashboard-listing">
        <span class="result-text mb-12" style="display:block;"><b>{{ $listings->total() }}</b> listing{{ $listings->total() !== 1 ? 's' : '' }}</span>
        <div class="tfcl-table-listing">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Listing</th>
                            <th>Status</th>
                            <th>Views</th>
                            <th>Enquiries</th>
                            <th>Posting Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="tfcl-table-content">
                        @foreach($listings as $listing)
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
                                        <a href="{{ route('my-listings.show', $listing->id) }}" wire:navigate>
                                            <img src="{{ $listing->cover_image_url }}" alt="{{ $listing->title }}" style="width:80px;height:56px;object-fit:cover;border-radius:6px;">
                                        </a>
                                    @endif
                                    <div class="tfcl-listing-summary">
                                        <h4 class="tfcl-listing-title">
                                            <a href="{{ route('my-listings.show', $listing->id) }}" wire:navigate>{{ $listing->title }}</a>
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
                                <div class="tfcl-listing-date">{{ number_format($listing->enquiries_count) }}</div>
                            </td>
                            <td class="column-date">
                                <div class="tfcl-listing-date">{{ $listing->created_at->format('d M Y') }}</div>
                            </td>
                            <td class="column-controller">
                                <div class="inner-controller">
                                    <a href="{{ route('my-listings.show', $listing->id) }}" wire:navigate class="btn-action tfcl-dashboard-action-edit">Details</a>
                                </div>
                                @if($listing->status === 'active')
                                <div class="inner-controller">
                                    <a href="{{ route('cars.show', $listing->slug) }}" wire:navigate class="btn-action tfcl-dashboard-action-edit">View</a>
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-24">
            {{ $listings->links() }}
        </div>
    </div>
@endif

@endsection
