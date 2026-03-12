<div class="flat-tabs">
    {{-- Condition Tabs --}}
    <div class="box-tab style2 center">
        <ul class="menu-tab tab-title flex" style="flex-wrap:nowrap;">
            <li class="item-title style {{ $condition === '' ? 'active' : '' }}" wire:click="$set('condition', '')" style="cursor:pointer;white-space:nowrap;">
                <span class="inner fs-15 fw-5 lh-20">All Cars</span>
            </li>
            <li class="item-title style {{ $condition === 'new' ? 'active' : '' }}" wire:click="$set('condition', 'new')" style="cursor:pointer;white-space:nowrap;">
                <span class="inner fs-15 fw-5 lh-20">New Cars</span>
            </li>
            <li class="item-title style {{ $condition === 'foreign_used' ? 'active' : '' }}" wire:click="$set('condition', 'foreign_used')" style="cursor:pointer;white-space:nowrap;">
                <span class="inner fs-15 fw-5 lh-20">Foreign Used</span>
            </li>
            <li class="item-title style {{ $condition === 'locally_used' ? 'active' : '' }}" wire:click="$set('condition', 'locally_used')" style="cursor:pointer;white-space:nowrap;">
                <span class="inner fs-15 fw-5 lh-20">Locally Used</span>
            </li>
        </ul>
    </div>

    <div class="content-tab style2">
        <div class="content-inner tab-content">
            <div class="form-sl">
                <div class="wd-find-select flex flex-wrap gap-8">
                    <div class="inner-group" style="display:flex;flex-wrap:wrap;gap:8px;flex:1;">

                        {{-- Make --}}
                        <div class="form-group-1" style="min-width:140px;flex:1;">
                            <label style="font-size:11px;font-weight:600;color:#64748b;display:block;margin-bottom:4px;">Make</label>
                            <select wire:model.live="brand_id" class="form-select" style="width:100%;padding:8px 12px;border:1.5px solid #e2e8f0;border-radius:6px;font-size:14px;background:#fff;">
                                <option value="">Any Make</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Model --}}
                        <div class="form-group-1" style="min-width:140px;flex:1;">
                            <label style="font-size:11px;font-weight:600;color:#64748b;display:block;margin-bottom:4px;">Model</label>
                            <select wire:model="model_id" class="form-select" style="width:100%;padding:8px 12px;border:1.5px solid #e2e8f0;border-radius:6px;font-size:14px;background:#fff;" {{ $models->isEmpty() ? 'disabled' : '' }}>
                                <option value="">Any Model</option>
                                @foreach($models as $model)
                                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Body Type --}}
                        <div class="form-group-1" style="min-width:130px;flex:1;">
                            <label style="font-size:11px;font-weight:600;color:#64748b;display:block;margin-bottom:4px;">Body Type</label>
                            <select wire:model="body_type" class="form-select" style="width:100%;padding:8px 12px;border:1.5px solid #e2e8f0;border-radius:6px;font-size:14px;background:#fff;">
                                <option value="">Any Type</option>
                                @foreach($bodyTypes as $bt)
                                    <option value="{{ $bt->slug }}">{{ $bt->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Min Price --}}
                        <div class="form-group-1" style="min-width:120px;flex:1;">
                            <label style="font-size:11px;font-weight:600;color:#64748b;display:block;margin-bottom:4px;">Min Price (KES)</label>
                            <select wire:model="min_price" class="form-select" style="width:100%;padding:8px 12px;border:1.5px solid #e2e8f0;border-radius:6px;font-size:14px;background:#fff;">
                                <option value="">No Min</option>
                                <option value="500000">500K</option>
                                <option value="1000000">1M</option>
                                <option value="2000000">2M</option>
                                <option value="3000000">3M</option>
                                <option value="5000000">5M</option>
                            </select>
                        </div>

                        {{-- Max Price --}}
                        <div class="form-group-1" style="min-width:120px;flex:1;">
                            <label style="font-size:11px;font-weight:600;color:#64748b;display:block;margin-bottom:4px;">Max Price (KES)</label>
                            <select wire:model="max_price" class="form-select" style="width:100%;padding:8px 12px;border:1.5px solid #e2e8f0;border-radius:6px;font-size:14px;background:#fff;">
                                <option value="">No Max</option>
                                <option value="1000000">1M</option>
                                <option value="2000000">2M</option>
                                <option value="3000000">3M</option>
                                <option value="5000000">5M</option>
                                <option value="10000000">10M</option>
                            </select>
                        </div>

                        {{-- Year --}}
                        <div class="form-group-1" style="min-width:100px;flex:1;">
                            <label style="font-size:11px;font-weight:600;color:#64748b;display:block;margin-bottom:4px;">Min Year</label>
                            <select wire:model="min_year" class="form-select" style="width:100%;padding:8px 12px;border:1.5px solid #e2e8f0;border-radius:6px;font-size:14px;background:#fff;">
                                <option value="">Any Year</option>
                                @foreach($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    {{-- Search Button --}}
                    <div style="display:flex;align-items:flex-end;">
                        <button wire:click="search"
                                wire:loading.attr="disabled"
                                type="button"
                                class="sc-button"
                                style="padding:10px 28px;white-space:nowrap;height:42px;display:flex;align-items:center;gap:8px;">
                            <span wire:loading.remove>
                                <i class="icon-autodeal-search"></i> Search
                            </span>
                            <span wire:loading>Searching…</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
