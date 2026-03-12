<footer id="footer" class="clearfix home">
    <div class="container">

        {{-- ── Footer Main ── --}}
        <div class="footer-main">
            <div class="row">

                {{-- Brand + tagline --}}
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="widget widget-menu footer-col-block">
                        <div class="footer-heading-desktop">
                            <span style="font-family:'DM Sans',sans-serif;font-weight:800;font-size:24px;color:#fff;letter-spacing:-0.5px;">
                                Auto<span style="color:var(--color-main);">Vault</span>
                            </span>
                        </div>
                        <p class="font-2" style="margin-top:12px;color:rgba(255,255,255,0.65);font-size:14px;line-height:1.7;">
                            Kenya's trusted car marketplace. Verified listings, AutoScore™ rated, WhatsApp-direct contact.
                        </p>
                        <div class="icon-social box-3 text-color-1" style="margin-top:16px;display:flex;gap:10px;">
                            <a href="#" aria-label="Facebook" style="width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;transition:background .2s;">
                                <i class="icon-autodeal-facebook"></i>
                            </a>
                            <a href="#" aria-label="Instagram" style="width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;transition:background .2s;">
                                <i class="icon-autodeal-instagram"></i>
                            </a>
                            <a href="#" aria-label="Twitter/X" style="width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;transition:background .2s;">
                                <i class="icon-autodeal-twitter"></i>
                            </a>
                            <a href="#" aria-label="YouTube" style="width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;transition:background .2s;">
                                <i class="icon-autodeal-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div class="col-lg-2 col-sm-6 col-12">
                    <div class="widget widget-menu footer-col-block">
                        <div class="footer-heading-desktop"><h4>Company</h4></div>
                        <div class="footer-heading-mobie"><h4>Company</h4></div>
                        <ul class="box-menu tf-collapse-content">
                            <li><a href="{{ route('about') }}" wire:navigate>About Us</a></li>
                            <li><a href="{{ route('contact') }}" wire:navigate>Contact</a></li>
                            <li><a href="{{ route('pricing') }}" wire:navigate>Pricing</a></li>
                            <li><a href="{{ route('faq') }}" wire:navigate>FAQ</a></li>
                            <li><a href="{{ route('blog') }}" wire:navigate>Blog</a></li>
                        </ul>
                    </div>
                </div>

                {{-- Browse --}}
                <div class="col-lg-2 col-sm-6 col-12">
                    <div class="widget widget-menu footer-col-block">
                        <div class="footer-heading-desktop"><h4>Browse Cars</h4></div>
                        <div class="footer-heading-mobie"><h4>Browse Cars</h4></div>
                        <ul class="box-menu tf-collapse-content">
                            <li><a href="{{ route('cars.index', ['body_type' => 'suv']) }}" wire:navigate>SUVs</a></li>
                            <li><a href="{{ route('cars.index', ['body_type' => 'sedan']) }}" wire:navigate>Sedans</a></li>
                            <li><a href="{{ route('cars.index', ['condition' => 'new']) }}" wire:navigate>New Cars</a></li>
                            <li><a href="{{ route('cars.index', ['condition' => 'foreign_used']) }}" wire:navigate>Foreign Used</a></li>
                            <li><a href="{{ route('cars.index', ['availability' => 'import']) }}" wire:navigate>Direct Imports</a></li>
                        </ul>
                    </div>
                </div>

                {{-- Legal + Contact --}}
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="widget widget-menu footer-col-block">
                        <div class="footer-heading-desktop"><h4>Get in Touch</h4></div>
                        <div class="footer-heading-mobie"><h4>Get in Touch</h4></div>
                        <ul class="box-menu tf-collapse-content">
                            <li class="flex-three gap-8">
                                <i class="icon-autodeal-map" aria-hidden="true"></i>
                                <span>Nairobi, Kenya</span>
                            </li>
                            <li class="flex-three gap-8">
                                <i class="icon-autodeal-phone" aria-hidden="true"></i>
                                <a href="tel:+254700000000">+254 700 000 000</a>
                            </li>
                            <li class="flex-three gap-8">
                                <i class="icon-autodeal-mail" aria-hidden="true"></i>
                                <a href="mailto:hello@autovault.co.ke">hello@autovault.co.ke</a>
                            </li>
                        </ul>
                        <div style="margin-top:16px;display:flex;gap:8px;flex-wrap:wrap;">
                            <a href="{{ route('privacy') }}" wire:navigate style="font-size:12px;color:rgba(255,255,255,0.5);">Privacy Policy</a>
                            <span style="color:rgba(255,255,255,0.25);">·</span>
                            <a href="{{ route('terms') }}" wire:navigate style="font-size:12px;color:rgba(255,255,255,0.5);">Terms of Service</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ── Footer Bottom ── --}}
        <div class="footer-bottom">
            <div class="row">
                <div class="col-12">
                    <div class="title-bottom center" style="text-align:center;">
                        &copy; {{ date('Y') }} AutoVault Kenya. All rights reserved.
                    </div>
                </div>
            </div>
        </div>

    </div>
</footer>
