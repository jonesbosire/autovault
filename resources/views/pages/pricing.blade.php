@extends('layouts.app')
@section('title', 'Pricing — AutoVault Kenya')

@section('content')

<section class="flat-title">
    <div class="container2">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-inner style">
                    <div class="title-group fs-12">
                        <a class="home fw-6 text-color-3" href="{{ route('home') }}" wire:navigate>Home</a>
                        <span>Pricing</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="tf-section3 flat-property">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-heading flex-two flex-wrap mb-40 gap-20">
                    <h1 class="heading-listing">Car listing plans</h1>
                    <div class="social-listing flex-six flex-wrap">
                        <p>Share this page:</p>
                        <div class="icon-social style1">
                            <a href="#"><i class="icon-autodeal-facebook"></i></a>
                            <a href="#"><i class="icon-autodeal-linkedin"></i></a>
                            <a href="#"><i class="icon-autodeal-twitter"></i></a>
                            <a href="#"><i class="icon-autodeal-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pricing Cards --}}
            <div class="col-lg-12 mb-60">
                <div class="row g-24">
                    @foreach($plans as $plan)
                    @php $popular = $plan->slug === 'growth'; @endphp
                    <div class="col-md-6 col-lg-3">
                        <div class="widget-pricing">
                            @if($popular)
                                <div class="badge-table"><span>Recommended</span></div>
                            @endif
                            <div class="pricing-heading">
                                <h2 class="sub-title">{{ $plan->name }}</h2>
                                <p class="text-sub lh-16 fs-12">{{ $plan->description ?? 'Perfect for sellers in Kenya looking to reach more buyers fast.' }}</p>
                            </div>
                            <div class="title-price flex-three">
                                <h2>KES</h2>
                                <div class="price fw-6 font text-color-2">{{ number_format($plan->price_monthly) }}</div>
                            </div>
                            <ul class="check">
                                <li class="flex-three check-icon">{{ $plan->isUnlimited() ? 'Unlimited listings' : $plan->max_listings . ' listing' . ($plan->max_listings > 1 ? 's' : '') }}</li>
                                <li class="flex-three check-icon">{{ $plan->listing_duration_days }}-day listing duration</li>
                                @if($plan->has_verified_badge)
                                    <li class="flex-three check-icon">Verified Seller badge</li>
                                @else
                                    <li class="flex-three de-check-icon">Verified Seller badge</li>
                                @endif
                                @if($plan->has_auto_score)
                                    <li class="flex-three check-icon">AutoScore trust rating</li>
                                @else
                                    <li class="flex-three de-check-icon">AutoScore trust rating</li>
                                @endif
                                @if($plan->has_featured_placement)
                                    <li class="flex-three check-icon">Featured placement</li>
                                @else
                                    <li class="flex-three de-check-icon">Featured placement</li>
                                @endif
                                @if($plan->has_priority_review)
                                    <li class="flex-three check-icon">Priority review (24h)</li>
                                @else
                                    <li class="flex-three de-check-icon">Priority review</li>
                                @endif
                                @if($plan->boost_credits > 0)
                                    <li class="flex-three check-icon">{{ $plan->boost_credits }} boost credits/month</li>
                                @else
                                    <li class="flex-three de-check-icon">Boost credits</li>
                                @endif
                                @if($plan->has_api_access)
                                    <li class="flex-three check-icon">API access</li>
                                @else
                                    <li class="flex-three de-check-icon">API access</li>
                                @endif
                            </ul>
                            <div class="button-pricing">
                                <a class="sc-button btn-1 w-100" wire:navigate
                                   href="{{ auth()->check() ? route('my-listings.create') : route('register') }}">
                                    <span>{{ $plan->max_listings == 1 ? 'Pay Per Listing' : 'Get Started' }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- What's included note --}}
            <div class="col-lg-12 mb-60">
                <div style="background:#f8fafc;border-radius:12px;padding:24px 32px;border:1.5px solid #e8ecf0;">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h5 class="fw-7 mb-8">All plans include</h5>
                            <div class="flex flex-wrap gap-16">
                                <span style="font-size:13px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:4px;"></i> WhatsApp buyer contact</span>
                                <span style="font-size:13px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:4px;"></i> Listing analytics</span>
                                <span style="font-size:13px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:4px;"></i> Mobile-optimised listings</span>
                                <span style="font-size:13px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:4px;"></i> M-Pesa & card payments</span>
                                <span style="font-size:13px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:4px;"></i> 47 counties coverage</span>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-16 mt-lg-0">
                            <a href="{{ route('contact') }}" wire:navigate class="sc-button style-1">
                                <span>Talk to Sales</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FAQ Section --}}
            <div class="col-lg-12">
                <h2 class="mb-40">Frequently asked questions</h2>
                <div class="flat-accordion">
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">What is AutoScore™?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">AutoScore is our proprietary 0–100 trust index calculated automatically for every listing. It factors in listing completeness, photo quality, price vs. market, seller history, and inspection status. Buyers use it to quickly gauge listing quality.</p>
                        </div>
                    </div>
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">How long does listing approval take?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">Our team reviews and approves listings within 24 hours on weekdays. Growth plan holders enjoy priority review, typically under 6 hours. You'll receive an email and WhatsApp notification when your listing goes live.</p>
                        </div>
                    </div>
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">What payment methods are accepted?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">We accept M-Pesa (Lipa Na M-Pesa), Visa, Mastercard, and bank transfer via Flutterwave. All transactions are secured and you receive a receipt immediately.</p>
                        </div>
                    </div>
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">Can I upgrade or change my plan?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">Yes. You can upgrade at any time from your account dashboard. You only pay the difference for the remaining period. Downgrades take effect at the start of the next billing cycle.</p>
                        </div>
                    </div>
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">Are there any hidden fees?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">No. The price you see is what you pay. There are no commission fees when your car sells. Boost credits, if used, are billed separately at a flat rate per boost.</p>
                        </div>
                    </div>
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">What is the refund policy?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">Listings that have not yet been approved are eligible for a full refund within 48 hours of purchase. Once a listing has been approved and published, refunds are not available. Contact our support team for exceptions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA Banner --}}
<section class="tf-banner style-2" style="min-height:200px;display:flex;align-items:center;text-align:center;">
    <div class="container">
        <div class="heading">
            <h2 class="text-color-1 mb-12">Ready to sell your car?</h2>
            <p class="text-color-1 fs-16 mb-24" style="opacity:0.9;">Join thousands of sellers who trust AutoVault to find serious buyers across Kenya.</p>
            <a href="{{ auth()->check() ? route('my-listings.create') : route('register') }}" wire:navigate
               class="sc-button btn-svg">
                <span>List Your Car Now</span>
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 7H13M13 7L7 1M13 7L7 13" stroke="CurrentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.querySelectorAll('.flat-toggle .toggle-title').forEach(function(title) {
    title.addEventListener('click', function() {
        var toggle = this.closest('.flat-toggle');
        var wasActive = toggle.classList.contains('active');
        document.querySelectorAll('.flat-toggle').forEach(function(t) { t.classList.remove('active'); });
        if (!wasActive) toggle.classList.add('active');
    });
});
</script>
@endpush

@endsection
