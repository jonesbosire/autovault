@extends('layouts.app')
@section('title', 'FAQ — AutoVault Kenya')
@section('meta_description', 'Frequently asked questions about buying and selling cars on AutoVault Kenya.')

@section('content')

<section class="flat-title">
    <div class="container2">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-inner style">
                    <div class="title-group fs-12">
                        <a class="home fw-6 text-color-3" href="{{ route('home') }}" wire:navigate>Home</a>
                        <span>Frequently Asked Questions</span>
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
                <div class="inner-heading flex-two flex-wrap gap-20">
                    <h1 class="heading-listing">Frequently asked questions</h1>
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

            {{-- Section: General --}}
            <div class="col-lg-12 mb-50">
                <h2 class="mb-40">General</h2>
                <div class="flat-accordion">
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">What is AutoVault Kenya?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">AutoVault is Kenya's trusted online car marketplace. We connect serious buyers with verified sellers across all 47 counties. Every listing gets an AutoScore™ trust rating powered by AI to help buyers make confident decisions.</p>
                        </div>
                    </div>
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">How do I search for a car?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">Use the search bar on the home page or browse the full listing page. You can filter by make, model, body type, condition, price range, year, and location. Results are updated instantly as you adjust your filters.</p>
                        </div>
                    </div>
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">Do I need an account to browse listings?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">No. You can browse and view all car listings without creating an account. However, to contact sellers via our enquiry form, save favourites, or list your own car, you'll need to register — it's free and takes less than a minute.</p>
                        </div>
                    </div>
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">What is AutoScore™?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">AutoScore™ is our proprietary 0–100 trust index calculated for every listing. It factors in listing completeness, photo quality, price vs. market rate, seller history, and inspection status. The higher the score, the more trustworthy and well-documented the listing.</p>
                        </div>
                    </div>
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">How do I contact a seller?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">Each car listing has a WhatsApp button that opens a direct chat with the seller, and an enquiry form to send your message securely through our platform. All contact details are only revealed to genuine enquiries to protect both buyer and seller.</p>
                        </div>
                    </div>
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">Are listings verified?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">Every listing is manually reviewed by our team before going live. Listings with a "Verified" badge have undergone an additional identity check of the seller. We recommend always meeting in person and conducting a pre-purchase inspection before completing any transaction.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section: Costs & Payments --}}
            <div class="col-lg-12 mb-50">
                <h2 class="mb-40">Costs &amp; Payments</h2>
                <div class="flat-accordion">
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">How much does it cost to list a car?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">Pricing starts with a pay-per-listing option for individual sellers. We also offer monthly plans for dealers with multiple listings. Visit our <a href="{{ route('pricing') }}" wire:navigate style="color:var(--color-main);">Pricing page</a> for current rates and plan comparisons.</p>
                        </div>
                    </div>
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">What payment methods are accepted?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">We accept M-Pesa (Lipa Na M-Pesa), Visa, Mastercard, and bank transfer via Flutterwave. All payments are processed securely and you receive an instant receipt to your email and phone.</p>
                        </div>
                    </div>
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">Are there any commission fees when I sell?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">No. AutoVault charges only for listing the car. We do not take any commission or percentage of the sale price. The deal is entirely between you and the buyer.</p>
                        </div>
                    </div>
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">What is the refund policy?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">Listings that have not yet been approved are eligible for a full refund within 48 hours. Once a listing is approved and published, we cannot offer refunds as the service has been rendered. Contact our support team at hello@autovault.co.ke for special circumstances.</p>
                        </div>
                    </div>
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">Can I upgrade my listing plan?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">Yes. You can upgrade to a higher plan at any time from your account dashboard and only pay the prorated difference for the remaining period. Downgrades take effect at the start of the next billing cycle.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section: Safety & Security --}}
            <div class="col-lg-12">
                <h2 class="mb-40">Safety &amp; Security</h2>
                <div class="flat-accordion">
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">How do I stay safe when buying?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">Always inspect the car in person before making any payment. Meet in a safe, public location such as a petrol station or shopping centre. Verify the logbook (log book) matches the seller's ID and the car's chassis number. Consider hiring a qualified mechanic for a pre-purchase inspection.</p>
                        </div>
                    </div>
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">Is my personal data protected?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">Yes. AutoVault is fully compliant with Kenya's Data Protection Act 2019. Your data is encrypted, never sold to third parties, and used only to provide and improve our services. Read our full <a href="{{ route('privacy') }}" wire:navigate style="color:var(--color-main);">Privacy Policy</a> for details.</p>
                        </div>
                    </div>
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">How do I report a suspicious listing?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">Use the "Report" button on any listing, or email us at hello@autovault.co.ke with the listing reference number and your concern. Our team investigates all reports within 24 hours and removes fraudulent listings immediately.</p>
                        </div>
                    </div>
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">How do I reset my password?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">On the login page, click "Forgot password?" and enter your registered email address. You'll receive a password reset link within a few minutes. Check your spam folder if it doesn't arrive. You can also sign in with Google if you registered that way.</p>
                        </div>
                    </div>
                    <div class="flat-toggle style-2">
                        <div class="toggle-title flex align-center">
                            <h5 class="fw-6">How do I delete my account?</h5>
                            <div class="btn-toggle"></div>
                        </div>
                        <div class="toggle-content section-desc">
                            <p class="texts">You can request account deletion by emailing hello@autovault.co.ke with subject "Account Deletion Request". Your account and all associated data will be permanently deleted within 30 days in accordance with Kenya's Data Protection Act.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- CTA --}}
<section class="flat-brand tf-section3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="title-section center mb-24">
                    <h3>Still have questions?</h3>
                    <p style="color:#64748b;margin-top:8px;">Our team is available Monday–Friday 8am–6pm and Saturday 9am–2pm.</p>
                </div>
                <div class="flex justify-content-center gap-16 flex-wrap">
                    <a href="{{ route('contact') }}" wire:navigate class="sc-button btn-svg">
                        <span>Contact Us</span>
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1 7H13M13 7L7 1M13 7L7 13" stroke="CurrentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    <a href="https://wa.me/254700100200" target="_blank" rel="noopener" class="btn-whatsapp">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.117.554 4.106 1.523 5.826L.057 23.43a.75.75 0 00.92.92l5.604-1.466A11.95 11.95 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22a9.95 9.95 0 01-5.093-1.397l-.363-.216-3.327.872.887-3.23-.234-.374A9.951 9.951 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
                        WhatsApp Support
                    </a>
                </div>
            </div>
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
