<header class="header main-header">
    <div class="header-lower">
        <div class="container2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-container flex justify-space align-center">

                        {{-- Logo --}}
                        <div class="logo-box flex">
                            <div class="logo">
                                <a href="{{ route('home') }}" wire:navigate>
                                    <span style="font-family:'DM Sans',sans-serif;font-weight:800;font-size:22px;color:var(--primary);letter-spacing:-0.5px;">Auto<span style="color:var(--color-main);">Vault</span></span>
                                </a>
                            </div>
                        </div>

                        {{-- Primary Nav --}}
                        <div class="nav-outer flex align-center">
                            <nav class="main-menu show navbar-expand-md" aria-label="Primary navigation">
                                <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                                    <ul class="navigation clearfix">
                                        <li class="{{ request()->routeIs('home') ? 'current' : '' }}">
                                            <a href="{{ route('home') }}" wire:navigate>Home</a>
                                        </li>
                                        <li class="dropdown2 {{ request()->routeIs('cars.*') ? 'current' : '' }}">
                                            <a href="{{ route('cars.index') }}" wire:navigate>Browse Cars</a>
                                            <ul>
                                                <li><a href="{{ route('cars.index') }}" wire:navigate>All Vehicles</a></li>
                                                <li><a href="{{ route('cars.index', ['condition' => 'new']) }}" wire:navigate>New Cars</a></li>
                                                <li><a href="{{ route('cars.index', ['condition' => 'foreign_used']) }}" wire:navigate>Foreign Used</a></li>
                                                <li><a href="{{ route('cars.index', ['availability' => 'import']) }}" wire:navigate>Direct Import</a></li>
                                            </ul>
                                        </li>
                                        <li class="{{ request()->routeIs('pricing') ? 'current' : '' }}">
                                            <a href="{{ route('pricing') }}" wire:navigate>Pricing</a>
                                        </li>
                                        <li class="{{ request()->routeIs('about') || request()->routeIs('contact') || request()->routeIs('faq') ? 'current' : '' }} dropdown2">
                                            <a href="{{ route('about') }}" wire:navigate>About</a>
                                            <ul>
                                                <li><a href="{{ route('about') }}" wire:navigate>About Us</a></li>
                                                <li><a href="{{ route('contact') }}" wire:navigate>Contact</a></li>
                                                <li><a href="{{ route('faq') }}" wire:navigate>FAQ</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>

                        {{-- Right: Actions --}}
                        <div class="header-account flex align-center">

                            {{-- Mobile Search Toggle --}}
                            <div class="search-mobie">
                                <a href="#" class="header-search-icon flex items-center justify-center" aria-label="Search">
                                    <i class="icon-autodeal-search search-icon fs-20"></i>
                                    <i class="icon-autodeal-plus search-icon fs-20"></i>
                                </a>
                                <div class="wd-find-select">
                                    <form action="{{ route('cars.index') }}" method="GET" role="search">
                                        <div class="form-group-1 search-form form-style2 relative">
                                            <i class="icon-autodeal-search"></i>
                                            <input type="search" class="search-field" name="q" placeholder="Search cars..." autocomplete="off" aria-label="Search cars">
                                        </div>
                                    </form>
                                </div>
                            </div>

                            {{-- Saved Cars --}}
                            <a href="{{ auth()->check() ? route('my-favorites') : route('login') }}"
                               wire:navigate
                               class="header-favorite flex items-center justify-center"
                               aria-label="Saved Cars">
                                <i class="icon-autodeal-favorite fs-18"></i>
                            </a>

                            {{-- Auth --}}
                            @auth
                                <div class="register">
                                    <ul class="flex align-center">
                                        <li><i class="icon-autodeal-user fs-20" aria-hidden="true"></i></li>
                                        <li><a href="{{ route('dashboard') }}" wire:navigate>{{ Str::words(auth()->user()->name, 1, '') }}</a></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                                                @csrf
                                                <button type="submit" style="background:none;border:none;cursor:pointer;color:inherit;font-size:14px;">Logout</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <div class="register">
                                    <ul class="flex align-center">
                                        <li><i class="icon-autodeal-user fs-20" aria-hidden="true"></i></li>
                                        <li><a href="{{ route('login') }}" wire:navigate>Login</a></li>
                                        <li><span>/</span></li>
                                        <li><a href="{{ route('register') }}" wire:navigate>Register</a></li>
                                    </ul>
                                </div>
                            @endauth

                            {{-- Primary CTA --}}
                            <div class="flat-bt-top">
                                <a class="sc-button" href="{{ route('my-listings.create') }}" wire:navigate>
                                    <svg width="16" height="16" viewBox="0 0 18 18" fill="none" aria-hidden="true">
                                        <path d="M9 1v16M1 9h16" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                                    </svg>
                                    <span>List Your Car</span>
                                </a>
                            </div>
                        </div>

                        <div class="mobile-nav-toggler mobile-button" aria-label="Open menu"><span></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div class="close-btn" aria-label="Close menu"><span class="icon flaticon-cancel-1"></span></div>
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <nav class="menu-box" aria-label="Mobile navigation">
            <div class="nav-logo">
                <a href="{{ route('home') }}" wire:navigate>
                    <span style="font-family:'DM Sans',sans-serif;font-weight:800;font-size:20px;">Auto<span style="color:var(--color-main);">Vault</span></span>
                </a>
            </div>
            <div class="bottom-canvas">
                <div class="login-box flex align-center">
                    <i class="icon-autodeal-user fs-20" aria-hidden="true"></i>
                    @auth
                        <a href="{{ route('dashboard') }}" wire:navigate class="fw-7 font-2">{{ auth()->user()->name }}</a>
                    @else
                        <a href="{{ route('login') }}" wire:navigate class="fw-7 font-2">Login / Register</a>
                    @endauth
                </div>
                <div class="menu-outer"></div>
                <div class="button-mobi-sell">
                    <a class="sc-button btn-icon center" href="{{ route('my-listings.create') }}" wire:navigate>
                        <span>List Your Car</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>
