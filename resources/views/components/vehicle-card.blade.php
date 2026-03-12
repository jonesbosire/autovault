@props(['vehicle'])

@php
    $compareIds = session('compare_ids', []);
    $inCompare  = in_array($vehicle->id, $compareIds);
    $saleStatus = match($vehicle->status ?? 'active') {
        'sold'     => ['label' => 'Sold',      'class' => 'av-status-badge--sold'],
        'reserved' => ['label' => 'Reserved',  'class' => 'av-status-badge--reserved'],
        default    => ['label' => 'Available', 'class' => 'av-status-badge--available'],
    };
@endphp

<div class="box-car-list hv-one">

    {{-- ── Image ── --}}
    <div class="image-group relative">
        <div class="top flex-two">
            {{-- Left: status + featured badges --}}
            <ul class="d-flex gap-6" style="flex-wrap:nowrap;align-items:center;padding:0;margin:0;list-style:none;">
                <li>
                    <span class="av-status-badge {{ $saleStatus['class'] }}">
                        <svg width="5" height="5" viewBox="0 0 6 6" fill="currentColor"><circle cx="3" cy="3" r="3"/></svg>
                        {{ $saleStatus['label'] }}
                    </span>
                </li>
                @if($vehicle->is_featured)
                <li>
                    <span class="av-status-badge av-status-badge--featured">
                        <svg width="8" height="8" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.86L12 18.56l-6.18 3.57L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        Featured
                    </span>
                </li>
                @endif
            </ul>
            {{-- Right: verified badge + year --}}
            <div style="display:flex;align-items:center;gap:5px;">
                @if($vehicle->is_verified)
                    <span title="Verified listing" class="av-verified-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="12" fill="#2563eb"/>
                            <path d="M7 12.5l3.5 3.5 6.5-7" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                @endif
                <div class="year flag-tag">{{ $vehicle->year }}</div>
            </div>
        </div>

        {{-- Sold overlay --}}
        @if(($vehicle->status ?? 'active') === 'sold')
            <div class="av-sold-overlay">
                <div class="av-sold-stamp">Sold</div>
            </div>
        @endif

        <div class="img-style">
            <img loading="lazy"
                 src="{{ $vehicle->cover_image_url ?? asset('assets/images/slider/slide3.jpg') }}"
                 alt="{{ $vehicle->title }}"
                 onerror="this.onerror=null;this.src='{{ asset('assets/images/slider/slide3.jpg') }}'">
        </div>

        {{-- Save + Compare --}}
        <div style="position:absolute;top:46px;right:8px;display:flex;flex-direction:column;gap:6px;z-index:2;">
            @auth
                <livewire:save-vehicle :vehicleId="$vehicle->id" :key="'save-'.$vehicle->id" />
            @else
                <a href="{{ route('login') }}" title="Sign in to save"
                   style="background:rgba(255,255,255,0.9);border:none;padding:0;width:34px;height:34px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 1px 4px rgba(0,0,0,0.15);text-decoration:none;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                </a>
            @endauth
            <form method="POST" action="{{ route('compare.toggle', $vehicle) }}">
                @csrf
                <button type="submit" title="{{ $inCompare ? 'Remove from compare' : 'Add to compare' }}"
                    style="background:{{ $inCompare ? '#e0e7ff' : 'rgba(255,255,255,0.9)' }};border:none;padding:0;width:34px;height:34px;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 1px 4px rgba(0,0,0,0.15);">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="{{ $inCompare ? '#4338ca' : '#64748b' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="3" width="6" height="18" rx="1"/><rect x="16" y="3" width="6" height="18" rx="1"/><path d="M8 12h8"/>
                    </svg>
                </button>
            </form>
        </div>

        {{-- AutoScore --}}
        @if($vehicle->auto_score)
        @php $cls = $vehicle->auto_score >= 90 ? 'excellent' : ($vehicle->auto_score >= 70 ? 'good' : ($vehicle->auto_score >= 50 ? 'fair' : 'poor')); @endphp
        <div style="position:absolute;bottom:8px;left:8px;">
            <span class="autoscore-badge {{ $cls }}">AutoScore™ {{ $vehicle->auto_score }}</span>
        </div>
        @endif
    </div>

    {{-- ── Specs strip ── --}}
    <div class="av-card-specs">
        <span><i class="icon-autodeal-km1"></i> {{ $vehicle->formatted_mileage }}</span>
        <span class="av-card-specs__sep">|</span>
        <span>{{ ucfirst($vehicle->transmission) }}</span>
        <span class="av-card-specs__sep">|</span>
        <span><i class="icon-autodeal-fuel"></i> {{ ucfirst($vehicle->fuel_type) }}</span>
        @if($vehicle->engine_cc)
        <span class="av-card-specs__sep">|</span>
        <span>{{ number_format($vehicle->engine_cc) }} CC</span>
        @endif
    </div>

    {{-- ── Content ── --}}
    <div class="content">
        <div class="text-address">
            <p class="text-color-3 font">{{ $vehicle->bodyType?->name ?? ucfirst(str_replace('_', ' ', $vehicle->condition)) }}</p>
        </div>
        <h5 class="link-style-1">
            <a href="{{ route('cars.show', $vehicle) }}" wire:navigate class="stretched-link">{{ Str::limit($vehicle->title, 48) }}</a>
        </h5>
        <div class="money fs-20 fw-5 lh-25 text-color-3">
            {{ $vehicle->formatted_price }}
            @if($vehicle->is_negotiable)
                <span style="font-size:11px;font-weight:400;color:#64748b;margin-left:4px;">Negotiable</span>
            @endif
        </div>
        <div class="days-box flex justify-space align-center" style="position:relative;z-index:2;">
            <div class="img-author" style="display:flex;align-items:center;gap:4px;">
                <svg width="12" height="14" viewBox="0 0 12 16" fill="none" style="flex-shrink:0;" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 0C3.24 0 1 2.24 1 5c0 3.75 5 11 5 11s5-7.25 5-11c0-2.76-2.24-5-5-5zm0 6.75A1.75 1.75 0 1 1 6 3.25a1.75 1.75 0 0 1 0 3.5z" fill="var(--color-main,#e53e3e)"/>
                </svg>
                <span class="font text-color-2 fw-5">{{ $vehicle->county ?? 'Kenya' }}</span>
            </div>
            <a href="{{ route('cars.show', $vehicle) }}" wire:navigate class="view-car" style="position:relative;z-index:2;">View car</a>
        </div>
    </div>
</div>
