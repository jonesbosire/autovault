@extends('layouts.app')
@section('title', 'Privacy Policy — AutoVault Kenya')

@section('content')

<section class="flat-title">
    <div class="container2">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-inner style">
                    <div class="title-group fs-12">
                        <a class="home fw-6 text-color-3" href="{{ route('home') }}" wire:navigate>Home</a>
                        <span>Privacy Policy</span>
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
                    <h1 class="heading-listing">Privacy Policy</h1>
                    <p style="font-size:13px;color:#64748b;margin:0;">Last updated: January 2026</p>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="section-desc">

                    <p class="texts mb-24">AutoVault Kenya is committed to protecting your privacy. This policy explains what data we collect, how we use it, and your rights under Kenya's Data Protection Act 2019.</p>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">1. Information We Collect</h3>
                    <p class="texts mb-16">We collect the following categories of personal data:</p>
                    <ul style="list-style:none;padding:0;margin:0 0 24px;">
                        <li style="padding:8px 0;border-bottom:1px solid #f1f5f9;font-size:14px;color:#475569;"><strong>Account data:</strong> Name, email address, phone number, and profile photo</li>
                        <li style="padding:8px 0;border-bottom:1px solid #f1f5f9;font-size:14px;color:#475569;"><strong>Listing data:</strong> Vehicle details, photos, price, and location you submit</li>
                        <li style="padding:8px 0;border-bottom:1px solid #f1f5f9;font-size:14px;color:#475569;"><strong>Transaction data:</strong> Payment records and subscription history</li>
                        <li style="padding:8px 0;border-bottom:1px solid #f1f5f9;font-size:14px;color:#475569;"><strong>Usage data:</strong> Pages visited, search queries, and device information</li>
                        <li style="padding:8px 0;font-size:14px;color:#475569;"><strong>Communications:</strong> Enquiry messages sent through our platform</li>
                    </ul>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">2. How We Use Your Data</h3>
                    <p class="texts mb-16">Your data is used to:</p>
                    <ul style="list-style:none;padding:0;margin:0 0 24px;">
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>Create and manage your account</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>Publish and display your vehicle listings</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>Process payments and issue receipts</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>Calculate AutoScore™ trust ratings</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>Send transactional emails and platform notifications</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>Improve our services through anonymised analytics</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>Comply with legal obligations</li>
                    </ul>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">3. Data Sharing</h3>
                    <p class="texts mb-16">We do not sell your personal data. We may share it with:</p>
                    <ul style="list-style:none;padding:0;margin:0 0 24px;">
                        <li style="padding:8px 0;border-bottom:1px solid #f1f5f9;font-size:14px;color:#475569;"><strong>Payment processors:</strong> Flutterwave and Safaricom (M-Pesa) to process transactions</li>
                        <li style="padding:8px 0;border-bottom:1px solid #f1f5f9;font-size:14px;color:#475569;"><strong>Email services:</strong> To send notifications and receipts</li>
                        <li style="padding:8px 0;border-bottom:1px solid #f1f5f9;font-size:14px;color:#475569;"><strong>Other users:</strong> Your listing details and contact info are visible to potential buyers</li>
                        <li style="padding:8px 0;font-size:14px;color:#475569;"><strong>Law enforcement:</strong> When required by Kenyan law or court order</li>
                    </ul>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">4. Cookies</h3>
                    <p class="texts mb-24">We use essential cookies to keep you logged in and protect against CSRF attacks. We also use analytics cookies (anonymised) to understand how users navigate our site. You can disable non-essential cookies in your browser settings. Essential cookies cannot be disabled as they are required for the site to function.</p>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">5. Data Retention</h3>
                    <p class="texts mb-24">We keep your account data for as long as your account is active and for up to 3 years after closure, unless a longer period is required by law. Listing data is retained for 12 months after a listing expires. Payment records are kept for 7 years for tax compliance.</p>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">6. Your Rights</h3>
                    <p class="texts mb-16">Under Kenya's Data Protection Act 2019, you have the right to:</p>
                    <ul style="list-style:none;padding:0;margin:0 0 24px;">
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>Access the personal data we hold about you</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>Correct inaccurate data</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>Request deletion of your data (right to erasure)</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>Object to processing of your data</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>Request a portable copy of your data</li>
                        <li style="padding:6px 0;font-size:14px;color:#475569;"><i class="icon-autodeal-check" style="color:var(--color-main);margin-right:8px;"></i>Withdraw consent at any time</li>
                    </ul>
                    <p class="texts mb-24">To exercise any of these rights, email us at <a href="mailto:privacy@autovault.co.ke" style="color:var(--color-main);">privacy@autovault.co.ke</a>. We will respond within 21 days.</p>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">7. Security</h3>
                    <p class="texts mb-24">We implement industry-standard security measures including SSL/TLS encryption, hashed passwords, and regular security audits. However, no internet transmission is 100% secure. We encourage you to use a strong, unique password and enable two-factor authentication when available.</p>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">8. Third-Party Links</h3>
                    <p class="texts mb-24">Our platform may contain links to external sites (e.g., WhatsApp, Google). We are not responsible for the privacy practices of those sites. Please review their policies independently.</p>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">9. Changes to This Policy</h3>
                    <p class="texts mb-24">We may update this policy from time to time. We will notify registered users of material changes via email. Continued use of the platform after changes constitutes acceptance of the updated policy.</p>

                    <h3 class="fw-7 mb-16" style="font-size:20px;">10. Contact</h3>
                    <p class="texts">For privacy enquiries, contact our Data Protection Officer at <a href="mailto:privacy@autovault.co.ke" style="color:var(--color-main);">privacy@autovault.co.ke</a> or write to: AutoVault Kenya Ltd, Westlands, Nairobi, Kenya.</p>

                </div>
            </div>

            <div class="col-lg-4">
                <div style="position:sticky;top:90px;">
                    <div class="box-sd" style="border-radius:12px;padding:24px;margin-bottom:20px;">
                        <h6 class="fw-7 mb-16" style="font-size:15px;">Your Rights Summary</h6>
                        <ul style="list-style:none;padding:0;margin:0;">
                            <li style="padding:7px 0;border-bottom:1px solid #f1f5f9;font-size:13px;color:#475569;display:flex;align-items:center;gap:8px;"><i class="icon-autodeal-check" style="color:var(--color-main);"></i> Access your data</li>
                            <li style="padding:7px 0;border-bottom:1px solid #f1f5f9;font-size:13px;color:#475569;display:flex;align-items:center;gap:8px;"><i class="icon-autodeal-check" style="color:var(--color-main);"></i> Correct inaccuracies</li>
                            <li style="padding:7px 0;border-bottom:1px solid #f1f5f9;font-size:13px;color:#475569;display:flex;align-items:center;gap:8px;"><i class="icon-autodeal-check" style="color:var(--color-main);"></i> Request deletion</li>
                            <li style="padding:7px 0;border-bottom:1px solid #f1f5f9;font-size:13px;color:#475569;display:flex;align-items:center;gap:8px;"><i class="icon-autodeal-check" style="color:var(--color-main);"></i> Data portability</li>
                            <li style="padding:7px 0;font-size:13px;color:#475569;display:flex;align-items:center;gap:8px;"><i class="icon-autodeal-check" style="color:var(--color-main);"></i> Withdraw consent</li>
                        </ul>
                        <a href="mailto:privacy@autovault.co.ke" class="sc-button style-1 w-100 mt-16" style="text-align:center;display:block;">
                            <span>Email DPO</span>
                        </a>
                    </div>
                    <div class="box-sd" style="border-radius:12px;padding:24px;">
                        <h6 class="fw-7 mb-12" style="font-size:15px;">Related Pages</h6>
                        <a href="{{ route('terms') }}" wire:navigate style="display:block;font-size:14px;color:var(--color-main);margin-bottom:8px;">Terms of Service</a>
                        <a href="{{ route('faq') }}" wire:navigate style="display:block;font-size:14px;color:var(--color-main);margin-bottom:8px;">FAQ</a>
                        <a href="{{ route('contact') }}" wire:navigate style="display:block;font-size:14px;color:var(--color-main);">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
