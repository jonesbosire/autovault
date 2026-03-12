@extends('layouts.dashboard')
@section('title', 'List Your Car')

@push('styles')
<style>
.wizard-input{width:100%;padding:11px 16px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;font-family:inherit;outline:none;transition:border-color .2s;background:#fff}
.wizard-input:focus{border-color:var(--color-main)}
.wizard-select{width:100%;padding:11px 16px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;font-family:inherit;outline:none;background:#fff;cursor:pointer;appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24'%3E%3Cpath fill='%2394a3b8' d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;transition:border-color .2s}
.wizard-select:focus{border-color:var(--color-main)}
.wizard-select:disabled{background-color:#f1f5f9;cursor:not-allowed}
.form-label-sm{font-size:13px;font-weight:600;color:var(--primary);margin-bottom:6px;display:block}
.field-error{font-size:12px;color:#dc2626;display:block;margin-top:4px}
.btn-prev{background:transparent;border:1.5px solid #e2e8f0;border-radius:8px;padding:12px 24px;font-size:14px;font-weight:600;color:var(--primary);cursor:pointer;font-family:inherit;transition:all .2s}
.btn-prev:hover{border-color:var(--color-main);color:var(--color-main)}
</style>
@endpush

@section('dashboard-content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;flex-wrap:wrap;gap:12px;">
    <div>
        <h1 class="admin-title" style="margin:0 0 4px;">Add New Listing</h1>
        <p style="font-size:13px;color:#64748b;margin:0;">Get your vehicle in front of thousands of buyers in Kenya</p>
    </div>
    <a href="{{ route('my-listings.index') }}" wire:navigate
       style="display:flex;align-items:center;gap:6px;padding:10px 18px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:13px;font-weight:600;color:var(--primary);text-decoration:none;">
        ← My Listings
    </a>
</div>

<div class="row">

    {{-- ── Wizard Column ── --}}
    <div class="col-lg-8">
        <div class="tfcl-add-listing" style="background:#fff;border-radius:16px;padding:32px;box-shadow:0 2px 24px rgba(0,0,0,.06);">
            @livewire('listing-wizard')
        </div>
    </div>

    {{-- ── Sidebar Tips ── --}}
    <div class="col-lg-4 d-none d-lg-block">

        <div class="widget-listing mb-16" style="padding:24px;">
            <h6 style="color:var(--primary);margin-bottom:16px;font-size:15px;">Why List on AutoVault?</h6>
            <div style="display:flex;flex-direction:column;gap:16px;">
                <div style="display:flex;gap:12px;align-items:flex-start;">
                    <div style="width:36px;height:36px;background:#f0f4ff;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-main)" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>
                    <div>
                        <div style="font-weight:600;font-size:13px;color:var(--primary);">AutoScore Verified</div>
                        <div style="font-size:12px;color:var(--color-text);margin-top:2px;">Every listing gets a trust score buyers can rely on</div>
                    </div>
                </div>
                <div style="display:flex;gap:12px;align-items:flex-start;">
                    <div style="width:36px;height:36px;background:#f0f4ff;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-main)" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.09 9.09 19.79 19.79 0 01.22 .4 2 2 0 012.2 0h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.27 7.11a16 16 0 006.16 6.16l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 14.17v2.75z"/></svg>
                    </div>
                    <div>
                        <div style="font-weight:600;font-size:13px;color:var(--primary);">WhatsApp-First Contact</div>
                        <div style="font-size:12px;color:var(--color-text);margin-top:2px;">Buyers reach you directly — no middlemen</div>
                    </div>
                </div>
                <div style="display:flex;gap:12px;align-items:flex-start;">
                    <div style="width:36px;height:36px;background:#f0f4ff;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-main)" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div>
                        <div style="font-weight:600;font-size:13px;color:var(--primary);">Verified Sellers Only</div>
                        <div style="font-size:12px;color:var(--color-text);margin-top:2px;">Our review weeds out fraud and builds buyer trust</div>
                    </div>
                </div>
                <div style="display:flex;gap:12px;align-items:flex-start;">
                    <div style="width:36px;height:36px;background:#f0f4ff;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-main)" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div>
                        <div style="font-weight:600;font-size:13px;color:var(--primary);">Live in 24 Hours</div>
                        <div style="font-size:12px;color:var(--color-text);margin-top:2px;">Submit today, get approved and live tomorrow</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="widget-listing" style="padding:20px;background:#f8faff;border:1.5px solid #c7d2fe;">
            <h6 style="color:var(--primary);margin-bottom:8px;font-size:13px;">Need a plan?</h6>
            <p style="font-size:12px;color:#64748b;margin-bottom:12px;">Check out our listing packages — from single listings to unlimited monthly plans.</p>
            <a href="{{ route('pricing') }}" wire:navigate style="font-size:13px;color:var(--color-main);font-weight:600;">
                View pricing & plans →
            </a>
        </div>

    </div>
</div>

@endsection
