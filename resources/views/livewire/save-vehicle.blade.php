<button wire:click="toggle"
    title="{{ $saved ? 'Remove from favourites' : 'Save to favourites' }}"
    style="background:none;border:none;padding:0;cursor:pointer;display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:50%;background:{{ $saved ? '#fee2e2' : 'rgba(255,255,255,0.9)' }};box-shadow:0 1px 4px rgba(0,0,0,0.15);transition:all .2s;">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="{{ $saved ? '#dc2626' : 'none' }}" stroke="{{ $saved ? '#dc2626' : '#64748b' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
    </svg>
</button>
