@extends('layouts.app')
@section('title', 'Terms of Service — AutoVault Kenya')

@section('content')

<section class="flat-title">
    <div class="container2">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-inner style">
                    <div class="title-group fs-12">
                        <a class="home fw-6 text-color-3" href="{{ route('home') }}" wire:navigate>Home</a>
                        <span>Terms of Service</span>
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
                    <h1 class="heading-listing">Terms of Service</h1>
                    <p style="font-size:13px;color:#64748b;margin:0;">Last updated: January 2026</p>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="section-desc">

                    <p class="texts mb-24">Welcome to AutoVault Kenya. By accessing or using our platform, you agree to be bound by these Terms of Service. Please read them carefully before using our services.</p>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">1. Acceptance of Terms</h3>
                    <p class="texts mb-24">By creating an account or using AutoVault's services, you confirm that you are at least 18 years of age, have the legal capacity to enter into a binding agreement, and accept these Terms in full. If you do not agree, you must not use our platform.</p>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">2. Our Services</h3>
                    <p class="texts mb-16">AutoVault provides an online marketplace for buying and selling vehicles in Kenya. We offer:</p>
                    <ul style="list-style:none;padding:0;margin:0 0 24px;">
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>Vehicle listing and search tools</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>Buyer-seller communication via enquiry forms and WhatsApp</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>AutoScore™ trust ratings and listing verification</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>Subscription plans for dealers and individual sellers</li>
                    </ul>
                    <p class="texts mb-24">AutoVault is a marketplace only. We do not buy, sell, or hold title to any vehicle. All transactions are between buyers and sellers directly.</p>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">3. User Accounts</h3>
                    <p class="texts mb-16">You are responsible for:</p>
                    <ul style="list-style:none;padding:0;margin:0 0 24px;">
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>Keeping your login credentials confidential</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>All activity that occurs under your account</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>Providing accurate and truthful information</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>Notifying us immediately of any unauthorised account access</li>
                    </ul>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">4. Listing Rules</h3>
                    <p class="texts mb-16">All listings must comply with the following:</p>
                    <ul style="list-style:none;padding:0;margin:0 0 24px;">
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>The vehicle must be legally owned by the seller or the seller must have authority to sell it</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>All information including price, mileage, condition, and photos must be accurate</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>No stolen, written-off, or encumbered vehicles may be listed</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>Photos must be of the actual vehicle, not stock images</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>No duplicate listings for the same vehicle</li>
                    </ul>
                    <p class="texts mb-24">AutoVault reserves the right to remove any listing that violates these rules without refund.</p>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">5. Prohibited Conduct</h3>
                    <p class="texts mb-24">You must not use AutoVault to: post fraudulent or misleading content, harass or threaten other users, scrape or harvest data from the platform, attempt to circumvent our security measures, or use the platform for any unlawful purpose.</p>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">6. Payments & Subscriptions</h3>
                    <p class="texts mb-24">All listing fees are payable in advance. By subscribing, you authorise us to charge your chosen payment method at the agreed rate. Subscription renewals are automatic unless cancelled at least 24 hours before the renewal date. We reserve the right to change pricing with 30 days' notice.</p>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">7. Limitation of Liability</h3>
                    <p class="texts mb-24">AutoVault is not liable for any loss or damage arising from transactions between buyers and sellers, the accuracy of listings, vehicle defects, or any disputes between users. Use the platform at your own risk. We recommend conducting due diligence before any vehicle purchase.</p>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">8. Intellectual Property</h3>
                    <p class="texts mb-24">All content on AutoVault — including our logo, AutoScore™ system, and platform design — is owned by AutoVault Kenya Ltd. You may not reproduce, distribute, or create derivative works without written permission. By posting content on our platform, you grant us a non-exclusive licence to display that content for the purpose of operating the service.</p>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">9. Termination</h3>
                    <p class="texts mb-24">We may suspend or terminate your account at any time if you violate these Terms. You may close your account at any time by contacting us. Termination does not entitle you to any refund for unused subscription periods.</p>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">10. Governing Law</h3>
                    <p class="texts mb-24">These Terms are governed by the laws of Kenya. Any disputes shall be subject to the exclusive jurisdiction of the courts of Nairobi, Kenya.</p>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">11. Contact</h3>
                    <p class="texts">For questions about these Terms, contact us at <a href="mailto:hello@autovault.co.ke" style="color:var(--color-main);">hello@autovault.co.ke</a> or visit our <a href="{{ route('contact') }}" wire:navigate style="color:var(--color-main);">Contact page</a>.</p>

                </div>
            </div>

            <div class="col-lg-4">
                <div style="position:sticky;top:90px;">
                    <div class="box-sd" style="border-radius:12px;padding:24px;margin-bottom:20px;">
                        <h6 class="fw-7 mb-16" style="font-size:15px;">Quick Links</h6>
                        <ul style="list-style:none;padding:0;margin:0;">
                            <li style="padding:8px 0;border-bottom:1px solid #f1f5f9;"><a href="#" style="font-size:14px;color:#475569;">1. Acceptance of Terms</a></li>
                            <li style="padding:8px 0;border-bottom:1px solid #f1f5f9;"><a href="#" style="font-size:14px;color:#475569;">2. Our Services</a></li>
                            <li style="padding:8px 0;border-bottom:1px solid #f1f5f9;"><a href="#" style="font-size:14px;color:#475569;">3. User Accounts</a></li>
                            <li style="padding:8px 0;border-bottom:1px solid #f1f5f9;"><a href="#" style="font-size:14px;color:#475569;">4. Listing Rules</a></li>
                            <li style="padding:8px 0;border-bottom:1px solid #f1f5f9;"><a href="#" style="font-size:14px;color:#475569;">5. Prohibited Conduct</a></li>
                            <li style="padding:8px 0;border-bottom:1px solid #f1f5f9;"><a href="#" style="font-size:14px;color:#475569;">6. Payments</a></li>
                            <li style="padding:8px 0;border-bottom:1px solid #f1f5f9;"><a href="#" style="font-size:14px;color:#475569;">7. Limitation of Liability</a></li>
                            <li style="padding:8px 0;"><a href="#" style="font-size:14px;color:#475569;">10. Governing Law</a></li>
                        </ul>
                    </div>
                    <div class="box-sd" style="border-radius:12px;padding:24px;">
                        <h6 class="fw-7 mb-12" style="font-size:15px;">Related Pages</h6>
                        <a href="{{ route('privacy') }}" wire:navigate style="display:block;font-size:14px;color:var(--color-main);margin-bottom:8px;">Privacy Policy</a>
                        <a href="{{ route('faq') }}" wire:navigate style="display:block;font-size:14px;color:var(--color-main);margin-bottom:8px;">FAQ</a>
                        <a href="{{ route('contact') }}" wire:navigate style="display:block;font-size:14px;color:var(--color-main);">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
