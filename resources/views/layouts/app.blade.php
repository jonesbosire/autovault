<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AutoVault') — Kenya&apos;s Trusted Car Marketplace</title>
    <meta name="description" content="@yield('meta_description', 'Find and list verified cars in Kenya. AutoVault is Kenya\'s most trusted car marketplace.')">

    {{-- DNS Prefetch --}}
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    {{-- DM Sans Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">

    {{-- Critical CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    {{-- Non-critical CSS: load asynchronously (animations & lightbox) --}}
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}"></noscript>
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}"></noscript>

    {{-- AutoVault Overrides --}}
    <link rel="stylesheet" href="{{ asset('css/autovault.css') }}">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/Favicon.png') }}">

    @livewireStyles
    @stack('styles')
</head>

<body class="body header-fixed">

<div class="preload preload-container">
    <div class="middle"></div>
</div>

<div id="wrapper">
    <div id="pagee" class="clearfix">

        {{-- Main Header --}}
        <x-layout.header />

        {{-- Page Content --}}
        @yield('content')

        {{-- Footer --}}
        <x-layout.footer />

    </div>
</div>

{{-- Compare Floating Bar --}}
<x-compare-bar />

{{-- Auth Modals --}}
<x-auth.login-modal />
<x-auth.register-modal />

{{-- Toast Notification Container --}}
<div id="av-toast-container" aria-live="polite" aria-atomic="true"></div>

{{-- Template JS --}}
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
<script src="{{ asset('assets/js/swiper.js') }}"></script>

@livewireScripts

{{-- ── Toast Notification System ── --}}
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
            type = type || 'info';
            duration = duration || 4000;
            var container = document.getElementById('av-toast-container');
            if (!container) return;

            var toast = document.createElement('div');
            toast.className = 'av-toast av-toast--' + type;
            toast.style.position = 'relative';
            toast.style.overflow = 'hidden';
            toast.innerHTML =
                '<div class="av-toast__icon">' + (ICONS[type] || ICONS.info) + '</div>' +
                '<div class="av-toast__body">' +
                    '<div class="av-toast__title">' + TITLES[type] + '</div>' +
                    '<div class="av-toast__msg">' + message + '</div>' +
                '</div>' +
                '<button class="av-toast__close" aria-label="Close">&times;</button>';

            container.appendChild(toast);

            // Animate in
            requestAnimationFrame(function () {
                requestAnimationFrame(function () { toast.classList.add('show'); });
            });

            // Close button
            toast.querySelector('.av-toast__close').addEventListener('click', function () { dismiss(toast); });
            toast.addEventListener('click', function () { dismiss(toast); });

            // Auto dismiss
            var timer = setTimeout(function () { dismiss(toast); }, duration);
            toast.addEventListener('mouseenter', function () { clearTimeout(timer); });
            toast.addEventListener('mouseleave', function () { timer = setTimeout(function () { dismiss(toast); }, 1500); });
        }
    };

    function dismiss(toast) {
        toast.classList.remove('show');
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(120%)';
        setTimeout(function () { if (toast.parentNode) toast.parentNode.removeChild(toast); }, 400);
    }

    // Show server-side flash messages on page load
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            AvToast.show(@json(session('success')), 'success');
        @endif
        @if(session('error'))
            AvToast.show(@json(session('error')), 'error');
        @endif
        @if(session('warning'))
            AvToast.show(@json(session('warning')), 'warning');
        @endif
        @if(session('status'))
            AvToast.show(@json(session('status')), 'info');
        @endif
        @if(session('info'))
            AvToast.show(@json(session('info')), 'info');
        @endif
    });

    // Livewire 3 event listener — dispatch('toast', {message: '...', type: 'success'})
    document.addEventListener('livewire:init', function () {
        Livewire.on('toast', function (data) {
            if (Array.isArray(data)) data = data[0];
            AvToast.show(data.message || data, data.type || 'info', data.duration || 4000);
        });
        Livewire.on('notify', function (data) {
            if (Array.isArray(data)) data = data[0];
            AvToast.show(data.message || data, data.type || 'info', data.duration || 4000);
        });
    });
})();
</script>

@stack('scripts')

</body>
</html>
