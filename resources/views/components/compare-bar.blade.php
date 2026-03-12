@php
    $compareIds = session('compare_ids', []);
    $count = count($compareIds);
@endphp

@if($count > 0)
@once @push('styles')<style>body{padding-bottom:80px!important}</style>@endpush @endonce
@php
    $vehicles = \App\Models\Vehicle::whereIn('id', $compareIds)
        ->select('id','slug','title','cover_image_url','price','year','brand_id')
        ->with('brand:id,name')
        ->get()
        ->sortBy(fn($v) => array_search($v->id, $compareIds));
@endphp

<div id="compare-bar" style="
    position:fixed;
    bottom:0;
    left:0;
    right:0;
    z-index:9999;
    background:#0f172a;
    border-top:3px solid var(--color-main);
    box-shadow:0 -4px 24px rgba(0,0,0,0.25);
    padding:12px 0;
    animation:slideUpBar .3s ease;
">
    <style>
    @keyframes slideUpBar{from{transform:translateY(100%)}to{transform:translateY(0)}}
    .compare-bar-car{display:flex;align-items:center;gap:10px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:8px 12px;position:relative;min-width:160px;}
    .compare-bar-car img{width:50px;height:36px;object-fit:cover;border-radius:4px;flex-shrink:0;}
    .compare-bar-car-title{font-size:12px;font-weight:600;color:#f1f5f9;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:100px;}
    .compare-bar-car-sub{font-size:11px;color:#94a3b8;}
    .compare-bar-remove{position:absolute;top:-8px;right:-8px;width:20px;height:20px;background:#dc2626;border-radius:50%;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:10px;color:#fff;font-weight:700;padding:0;line-height:1;}
    .compare-bar-slot{display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,0.03);border:2px dashed rgba(255,255,255,0.15);border-radius:8px;padding:8px 24px;min-width:160px;min-height:54px;}
    </style>

    <div class="container">
        <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">

            {{-- Label --}}
            <div style="flex-shrink:0;">
                <div style="font-size:11px;color:#94a3b8;text-transform:uppercase;letter-spacing:1px;font-weight:600;">Compare</div>
                <div style="font-size:18px;font-weight:800;color:#fff;line-height:1.1;">{{ $count }}/3 Cars</div>
            </div>

            {{-- Divider --}}
            <div style="width:1px;height:44px;background:rgba(255,255,255,0.1);flex-shrink:0;"></div>

            {{-- Car Slots --}}
            <div style="display:flex;gap:8px;flex:1;flex-wrap:wrap;align-items:center;">
                @foreach($vehicles as $v)
                <div class="compare-bar-car">
                    <img src="{{ $v->cover_image_url ?? asset('assets/images/slider/slide3.jpg') }}" alt="{{ $v->title }}">
                    <div style="overflow:hidden;">
                        <div class="compare-bar-car-title">{{ $v->title }}</div>
                        <div class="compare-bar-car-sub">{{ $v->year }} · {{ $v->brand->name ?? '' }}</div>
                    </div>
                    {{-- Remove button --}}
                    <form method="POST" action="{{ route('compare.remove', $v) }}" style="display:contents;">
                        @csrf
                        <button type="submit" class="compare-bar-remove" title="Remove">✕</button>
                    </form>
                </div>
                @endforeach

                {{-- Empty slots --}}
                @for($i = $count; $i < 3; $i++)
                <div class="compare-bar-slot">
                    <span style="font-size:12px;color:rgba(255,255,255,0.3);">+ Add car</span>
                </div>
                @endfor
            </div>

            {{-- Actions --}}
            <div style="display:flex;gap:8px;flex-shrink:0;flex-wrap:wrap;">
                @if($count >= 2)
                <a href="{{ route('compare') }}" wire:navigate
                   class="sc-button" style="white-space:nowrap;font-size:13px;padding:11px 20px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:4px;"><rect x="2" y="3" width="6" height="18" rx="1"/><rect x="16" y="3" width="6" height="18" rx="1"/><path d="M8 12h8"/></svg>
                    <span>Compare Now</span>
                </a>
                @endif
                <form method="POST" action="{{ route('compare.clear') }}">
                    @csrf
                    <button type="submit" style="background:transparent;border:1px solid rgba(255,255,255,0.2);border-radius:8px;padding:10px 16px;font-size:12px;color:#94a3b8;cursor:pointer;font-family:inherit;white-space:nowrap;">
                        Clear All
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endif
