<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — AutoVault</title>
    <meta name="description" content="@yield('meta_description', 'Manage your AutoVault account, listings and favourites.')">

    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}"></noscript>
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}"></noscript>
    <link rel="stylesheet" href="{{ asset('css/autovault.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/Favicon.png') }}">

    @livewireStyles
    @stack('styles')
</head>

<body class="body">

<div class="preload preload-container"><div class="middle"></div></div>

{{-- Sidebar Overlay (mobile) --}}
<div class="dashboard-overlay"></div>

{{-- ── Sidebar ── --}}
<aside class="sidebar-dashboard">
    <div class="db-content db-logo pad-30">
        <a href="{{ route('home') }}" title="AutoVault">
            <img class="site-logo" src="{{ asset('assets/images/logo/logo@2x.png') }}" alt="AutoVault" style="max-width:150px;filter:brightness(0) invert(1);">
        </a>
    </div>

    <div class="db-content db-author pad-30">
        <h6 class="db-title">Profile</h6>
        <div class="author">
            <div class="avatar">
                @if(auth()->user()->avatar_url)
                    <img loading="lazy" src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}">
                @else
                    <div style="width:48px;height:48px;border-radius:50%;background:rgba(255,255,255,0.25);display:flex;align-items:center;justify-content:center;font-size:20px;font-weight:700;color:#fff;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
            </div>
            <div class="content">
                <div class="name">{{ Str::words(auth()->user()->name, 2, '') }}</div>
                <div class="author-email">{{ Str::limit(auth()->user()->email, 22) }}</div>
            </div>
        </div>
    </div>

    <div class="db-content db-list-menu">
        <h6 class="db-title">Menu</h6>
        <div class="db-dashboard-menu">
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                            <path d="M6.92479 9.35156V15.64" stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M11.2021 6.34375V15.6412" stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15.4092 12.6758V15.6412" stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.4619 1.83398H6.87143C3.87698 1.83398 2 3.95339 2 6.95371V15.0476C2 18.0479 3.86825 20.1673 6.87143 20.1673H15.4619C18.4651 20.1673 20.3333 18.0479 20.3333 15.0476V6.95371C20.3333 3.95339 18.4651 1.83398 15.4619 1.83398Z" stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('my-listings.index') }}" class="{{ request()->routeIs('my-listings*') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                            <path d="M10.0135 2.55687H6.58608C3.76733 2.55687 2 4.55245 2 7.37762V14.9988C2 17.824 3.75908 19.8195 6.58608 19.8195H14.6747C17.5027 19.8195 19.2617 17.824 19.2617 14.9988V11.3065" stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.57059 10.0111L14.4208 3.16086C15.2743 2.30836 16.6575 2.30836 17.5109 3.16086L18.6265 4.27644C19.4799 5.12986 19.4799 6.51403 18.6265 7.36653L11.7433 14.2498C11.3702 14.6229 10.8642 14.8328 10.3362 14.8328H6.90234L6.98851 11.3678C7.00134 10.8581 7.20943 10.3723 7.57059 10.0111Z" stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.3789 4.21875L17.5644 8.40425" stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        My Listings
                    </a>
                </li>
                <li>
                    <a href="{{ route('my-favorites') }}" class="{{ request()->routeIs('my-favorites') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.34088 10.6318C1.35729 7.56096 2.50679 4.05104 5.73071 3.01246C7.42654 2.46521 9.29838 2.78788 10.7082 3.84846C12.042 2.81721 13.9825 2.46888 15.6765 3.01246C18.9005 4.05104 20.0573 7.56096 19.0746 10.6318C17.5438 15.4993 10.7082 19.2485 10.7082 19.2485C10.7082 19.2485 3.92304 15.5561 2.34088 10.6318Z" stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.375 6.14258C15.3558 6.45974 16.0488 7.33516 16.1322 8.36274" stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        My Favorites
                    </a>
                </li>
                <li>
                    <a href="{{ route('compare') }}" class="{{ request()->routeIs('compare') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                            <path d="M3 7h16M3 12h10M3 17h6" stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M17 10l3 3-3 3" stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Compare Cars
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5729 14.0684C7.02762 14.0684 4 14.6044 4 16.7511C4 18.8979 7.00841 19.4531 10.5729 19.4531C14.1183 19.4531 17.145 18.9162 17.145 16.7703C17.145 14.6245 14.1375 14.0684 10.5729 14.0684Z" stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5726 11.0056C12.8992 11.0056 14.7849 9.11897 14.7849 6.79238C14.7849 4.46579 12.8992 2.58008 10.5726 2.58008C8.24599 2.58008 6.3594 4.46579 6.3594 6.79238C6.35154 9.11111 8.22503 10.9977 10.5429 11.0056H10.5726Z" stroke="#F1FAEE" stroke-width="1.42857" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        My Profile
                    </a>
                </li>
                <li>
                    <a href="{{ route('my-listings.create') }}" class="{{ request()->routeIs('my-listings.create') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                            <path d="M11 2v18M2 11h18" stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        List a Car
                    </a>
                </li>
                <li>
                    <a href="{{ route('pricing') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                            <path d="M11 2C6.03 2 2 6.03 2 11s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9zm.5 13.5h-1v-5h1v5zm0-7h-1V7h1v1.5z" fill="#F1FAEE" opacity="0.6"/>
                        </svg>
                        Upgrade Plan
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" style="background:none;border:none;padding:0;width:100%;text-align:left;cursor:pointer;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                <path d="M13.2237 6.77418V5.91893C13.2237 4.05352 11.7112 2.54102 9.84575 2.54102H5.377C3.5125 2.54102 2 4.05352 2 5.91893V16.1214C2 17.9868 3.5125 19.4993 5.377 19.4993H9.85492C11.7148 19.4993 13.2237 17.9914 13.2237 16.1315V15.2671" stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M19.4516 11.0208H8.41406" stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16.7656 8.34766L19.4496 11.0197L16.7656 13.6927" stroke="#F1FAEE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</aside>

{{-- ── Dashboard Wrapper ── --}}
<div id="wrapper-dashboard">
    <div id="pagee" class="clearfix">

        <x-layout.header />

        <div id="themesflat-content">
            <div class="dashboard-toggle">Show Dashboard</div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content-area">
                            <main id="main" class="main-content">
                                <div class="tfcl-dashboard">
                                    @yield('dashboard-content')
                                </div>
                            </main>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-layout.footer />
    </div>
</div>

<x-auth.login-modal />
<x-auth.register-modal />

<div id="av-toast-container" aria-live="polite" aria-atomic="true"></div>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.easing.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('assets/js/lazysize.min.js') }}"></script>
<script src="{{ asset('assets/js/price-ranger.js') }}"></script>
<script src="{{ asset('assets/js/plugin.js') }}"></script>
<script src="{{ asset('assets/js/shortcodes.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

@livewireScripts

<script>
(function () {
    var ICONS = {
        success: '<svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>',
        error:   '<svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>',
        warning: '<svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>',
        info:    '<svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>',
    };
    var TITLES = { success: 'Success', error: 'Error', warning: 'Warning', info: 'Notice' };
    window.AvToast = {
        show: function (message, type, duration) {
            type = type || 'info'; duration = duration || 4000;
            var container = document.getElementById('av-toast-container');
            if (!container) return;
            var toast = document.createElement('div');
            toast.className = 'av-toast av-toast--' + type;
            toast.style.cssText = 'position:relative;overflow:hidden;';
            toast.innerHTML = '<div class="av-toast__icon">' + (ICONS[type] || ICONS.info) + '</div>' +
                '<div class="av-toast__body"><div class="av-toast__title">' + TITLES[type] + '</div><div class="av-toast__msg">' + message + '</div></div>' +
                '<button class="av-toast__close" aria-label="Close">&times;</button>';
            container.appendChild(toast);
            requestAnimationFrame(function () { requestAnimationFrame(function () { toast.classList.add('show'); }); });
            toast.querySelector('.av-toast__close').addEventListener('click', function () { dismiss(toast); });
            toast.addEventListener('click', function () { dismiss(toast); });
            var timer = setTimeout(function () { dismiss(toast); }, duration);
            toast.addEventListener('mouseenter', function () { clearTimeout(timer); });
            toast.addEventListener('mouseleave', function () { timer = setTimeout(function () { dismiss(toast); }, 1500); });
        }
    };
    function dismiss(toast) {
        toast.classList.remove('show'); toast.style.opacity = '0'; toast.style.transform = 'translateX(120%)';
        setTimeout(function () { if (toast.parentNode) toast.parentNode.removeChild(toast); }, 400);
    }
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success')) AvToast.show(@json(session('success')), 'success'); @endif
        @if(session('error'))   AvToast.show(@json(session('error')),   'error');   @endif
        @if(session('warning')) AvToast.show(@json(session('warning')), 'warning'); @endif
        @if(session('status'))  AvToast.show(@json(session('status')),  'info');    @endif
        @if(session('info'))    AvToast.show(@json(session('info')),    'info');    @endif
    });
    document.addEventListener('livewire:init', function () {
        Livewire.on('toast', function (data) { if (Array.isArray(data)) data = data[0]; AvToast.show(data.message || data, data.type || 'info', data.duration || 4000); });
        Livewire.on('notify', function (data) { if (Array.isArray(data)) data = data[0]; AvToast.show(data.message || data, data.type || 'info', data.duration || 4000); });
    });
})();
</script>

@stack('scripts')
</body>
</html>
