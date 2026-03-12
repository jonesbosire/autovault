@extends('layouts.app')

@section('title', 'Login')

@section('content')

<section class="flat-section" style="min-height:80vh;display:flex;align-items:center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">

                <div class="box-login" style="background:#fff;border-radius:16px;padding:40px;box-shadow:0 4px 24px rgba(0,0,0,.08);">

                    <div class="text-center mb-28">
                        <a href="{{ route('home') }}" wire:navigate>
                            <span style="font-family:'DM Sans',sans-serif;font-weight:700;font-size:28px;color:var(--primary);">Auto<span style="color:var(--color-main);">Vault</span></span>
                        </a>
                        <p class="mt-8" style="color:var(--color-text);font-size:15px;">Sign in to your account</p>
                    </div>

                    {{-- Validation Errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger mb-16">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-16">
                            <label style="font-size:13px;font-weight:600;color:var(--primary);margin-bottom:6px;display:block;">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                   style="width:100%;padding:12px 16px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;font-family:inherit;outline:none;transition:border .2s;"
                                   onfocus="this.style.borderColor='var(--color-main)'" onblur="this.style.borderColor='#e2e8f0'">
                        </div>

                        <div class="mb-16">
                            <label style="font-size:13px;font-weight:600;color:var(--primary);margin-bottom:6px;display:block;">Password</label>
                            <input type="password" name="password" required
                                   style="width:100%;padding:12px 16px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;font-family:inherit;outline:none;transition:border .2s;"
                                   onfocus="this.style.borderColor='var(--color-main)'" onblur="this.style.borderColor='#e2e8f0'">
                        </div>

                        <div class="flex justify-space align-center mb-20">
                            <label style="display:flex;align-items:center;gap:8px;font-size:13px;cursor:pointer;">
                                <input type="checkbox" name="remember" style="width:16px;height:16px;cursor:pointer;">
                                Remember me
                            </label>
                            @if(Route::has('password.request'))
                                <a href="{{ route('password.request') }}" style="font-size:13px;color:var(--color-main);">Forgot password?</a>
                            @endif
                        </div>

                        <button type="submit" class="sc-button" style="width:100%;justify-content:center;padding:14px;">
                            Sign In
                        </button>
                    </form>

                    <div class="divider" style="display:flex;align-items:center;gap:12px;margin:24px 0;">
                        <div style="flex:1;height:1px;background:#e2e8f0;"></div>
                        <span style="font-size:12px;color:#94a3b8;white-space:nowrap;">OR CONTINUE WITH</span>
                        <div style="flex:1;height:1px;background:#e2e8f0;"></div>
                    </div>

                    <a href="{{ route('auth.google') }}"
                       style="display:flex;align-items:center;justify-content:center;gap:10px;width:100%;padding:12px 16px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;font-weight:600;color:var(--primary);text-decoration:none;transition:all .2s;"
                       onmouseover="this.style.borderColor='var(--color-main)';this.style.background='#f8faff';"
                       onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#fff';">
                        <svg width="20" height="20" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        Continue with Google
                    </a>

                    <p class="text-center mt-24" style="font-size:13px;color:var(--color-text);">
                        Don't have an account?
                        <a href="{{ route('register') }}" wire:navigate style="color:var(--color-main);font-weight:600;">Create one</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
