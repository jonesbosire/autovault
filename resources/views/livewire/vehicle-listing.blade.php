<div>
    <div class="row">

        {{-- ── Sidebar Filters ────────────────────────────────────── --}}
        <div class="col-lg-3 col-md-4">
            <div class="widget-sidebar box-sd" style="position:sticky;top:90px;padding:0;overflow:hidden;">

                <div style="background:var(--color-main,#e53e3e);padding:16px 20px;">
                    <h6 style="font-size:14px;font-weight:700;color:#fff;margin:0;">Filter Listings</h6>
                </div>

                <div style="padding:20px;">

                    {{-- Search --}}
                    <div class="widget widget-price mb-20">
                        <div class="title-widget">Search</div>
                        <input wire:model.live.debounce.400ms="q"
                               type="text"
                               placeholder="Make, model, keyword..."
                               class="tb-my-input"
                               style="width:100%;">
                    </div>

                    {{-- Make --}}
                    <div class="widget widget-price mb-20">
                        <div class="title-widget">Make</div>
                        <div class="group-select">
                            <select wire:model.live="brand" class="tb-my-input" style="width:100%;">
                                <option value="">Any Make</option>
                                @foreach($brands as $b)
                                    <option value="{{ $b->slug }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Model --}}
                    @if($models->isNotEmpty())
                    <div class="widget widget-price mb-20">
                        <div class="title-widget">Model</div>
                        <div class="group-select">
                            <select wire:model.live="model" class="tb-my-input" style="width:100%;">
                                <option value="">Any Model</option>
                                @foreach($models as $m)
                                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    {{-- Body Type --}}
                    <div class="widget widget-price mb-20">
                        <div class="title-widget">Body Type</div>
                        <div class="group-select">
                            <select wire:model.live="body_type" class="tb-my-input" style="width:100%;">
                                <option value="">Any Type</option>
                                @foreach($bodyTypes as $bt)
                                    <option value="{{ $bt->slug }}">{{ $bt->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Condition --}}
                    <div class="widget widget-price mb-20">
                        <div class="title-widget">Condition</div>
                        <div class="group-select">
                            <select wire:model.live="condition" class="tb-my-input" style="width:100%;">
                                <option value="">Any Condition</option>
                                <option value="new">New</option>
                                <option value="foreign_used">Foreign Used</option>
                                <option value="locally_used">Locally Used</option>
                            </select>
                        </div>
                    </div>

                    {{-- Price Range --}}
                    <div class="widget widget-price mb-20">
                        <div class="title-widget">Price (KES)</div>
                        <div class="flex gap-8">
                            <select wire:model.live="min_price" class="tb-my-input" style="flex:1;">
                                <option value="">Min</option>
                                <option value="200000">200K</option>
                                <option value="500000">500K</option>
                                <option value="1000000">1M</option>
                                <option value="2000000">2M</option>
                                <option value="3000000">3M</option>
                                <option value="5000000">5M</option>
                            </select>
                            <select wire:model.live="max_price" class="tb-my-input" style="flex:1;">
                                <option value="">Max</option>
                                <option value="500000">500K</option>
                                <option value="1000000">1M</option>
                                <option value="2000000">2M</option>
                                <option value="3000000">3M</option>
                                <option value="5000000">5M</option>
                                <option value="10000000">10M</option>
                                <option value="20000000">20M+</option>
                            </select>
                        </div>
                    </div>

                    {{-- Year --}}
                    <div class="widget widget-price mb-20">
                        <div class="title-widget">Year</div>
                        <div class="flex gap-8">
                            <select wire:model.live="min_year" class="tb-my-input" style="flex:1;">
                                <option value="">From</option>
                                @foreach(range(date('Y'), 1990) as $yr)
                                    <option value="{{ $yr }}">{{ $yr }}</option>
                                @endforeach
                            </select>
                            <select wire:model.live="max_year" class="tb-my-input" style="flex:1;">
                                <option value="">To</option>
                                @foreach(range(date('Y'), 1990) as $yr)
                                    <option value="{{ $yr }}">{{ $yr }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- County --}}
                    @if($counties->isNotEmpty())
                    <div class="widget widget-price mb-20">
                        <div class="title-widget">Location</div>
                        <div class="group-select">
                            <select wire:model.live="county" class="tb-my-input" style="width:100%;">
                                <option value="">All Counties</option>
                                @foreach($counties as $c)
                                    <option value="{{ $c }}">{{ $c }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    {{-- Availability --}}
                    <div class="widget widget-price mb-24">
                        <div class="title-widget">Availability</div>
                        <div class="group-select">
                            <select wire:model.live="availability" class="tb-my-input" style="width:100%;">
                                <option value="">All</option>
                                <option value="local">In Kenya</option>
                                <option value="import">Direct Import</option>
                            </select>
                        </div>
                    </div>

                    {{-- Clear --}}
                    <button wire:click="clearFilters" type="button" class="sc-button style-1 w-100">
                        <span>Clear All Filters</span>
                    </button>

                </div>
            </div>
        </div>

        {{-- ── Results ─────────────────────────────────────────────── --}}
        <div class="col-lg-9 col-md-8">

            {{-- Results header --}}
            <div class="flex justify-space align-center flex-wrap gap-12 mb-24">
                <p style="font-size:15px;color:#64748b;margin:0;">
                    <strong style="color:#1a202c;">{{ number_format($total) }}</strong> vehicles found
                    <span wire:loading style="font-size:12px;color:var(--color-main);">— updating…</span>
                </p>
                <div class="flex align-center gap-8">
                    <label style="font-size:13px;color:#64748b;white-space:nowrap;">Sort:</label>
                    <select wire:model.live="sort" class="tb-my-input" style="padding:8px 14px;min-width:180px;">
                        <option value="latest">Latest First</option>
                        <option value="price_asc">Price: Low to High</option>
                        <option value="price_desc">Price: High to Low</option>
                        <option value="mileage">Lowest Mileage</option>
                        <option value="oldest">Oldest Year</option>
                    </select>
                </div>
            </div>

            {{-- Loading overlay --}}
            <div wire:loading.delay class="text-center" style="padding:40px 0;">
                <div class="preload preload-container" style="position:relative;width:60px;height:60px;margin:0 auto;">
                    <div class="middle"></div>
                </div>
            </div>

            {{-- Grid --}}
            <div wire:loading.remove>
                @if($vehicles->isEmpty())
                    <div class="text-center" style="padding:80px 20px;">
                        <div style="margin-bottom:20px;">
                            <svg width="70" height="50" viewBox="0 0 60 40" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M55 15H50L43.75 5H16.25L10 15H5C3.625 15 2.5 16.125 2.5 17.5V30C2.5 30.688 3.063 31.25 3.75 31.25H6.25C6.25 34.012 8.488 36.25 11.25 36.25C14.012 36.25 16.25 34.012 16.25 31.25H43.75C43.75 34.012 45.988 36.25 48.75 36.25C51.512 36.25 53.75 34.012 53.75 31.25H56.25C56.938 31.25 57.5 30.688 57.5 30V17.5C57.5 16.125 56.375 15 55 15ZM11.25 33.75C9.875 33.75 8.75 32.625 8.75 31.25C8.75 29.875 9.875 28.75 11.25 28.75C12.625 28.75 13.75 29.875 13.75 31.25C13.75 32.625 12.625 33.75 11.25 33.75ZM48.75 33.75C47.375 33.75 46.25 32.625 46.25 31.25C46.25 29.875 47.375 28.75 48.75 28.75C50.125 28.75 51.25 29.875 51.25 31.25C51.25 32.625 50.125 33.75 48.75 33.75ZM12.5 20L17.5 10H42.5L47.5 20H12.5Z" fill="#CBD5E1"/></svg>
                        </div>
                        <h5 class="mb-8">No vehicles found</h5>
                        <p style="color:#64748b;">Try adjusting your filters or
                            <button wire:click="clearFilters" style="background:none;border:none;color:var(--color-main);cursor:pointer;font-weight:600;font-size:inherit;padding:0;">clear all filters</button>.
                        </p>
                    </div>
                @else
                    <div class="row gy-4 gx-3">
                        @foreach($vehicles as $vehicle)
                            <div class="col-sm-6 col-xl-4">
                                <x-vehicle-card :vehicle="$vehicle" />
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="themesflat-pagination mt-40">
                        {{ $vehicles->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
