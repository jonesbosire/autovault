@extends('layouts.app')
@section('title', $post['title'] . ' — AutoVault Blog')

@section('content')

<section class="tf-banner style-2">
    <div class="container">
        <div class="heading">
            <span class="fs-14 text-color-1" style="opacity:0.75;">
                <a href="{{ route('blog') }}" wire:navigate class="text-color-1">Blog</a>
                / {{ $post['category'] }}
            </span>
            <h2 class="text-color-1 mt-8">{{ $post['title'] }}</h2>
        </div>
    </div>
</section>

<section class="flat-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">

                {{-- Post Image --}}
                <div style="border-radius:12px;overflow:hidden;margin-bottom:28px;">
                    <img src="{{ asset($post['image']) }}" alt="{{ $post['title'] }}"
                         style="width:100%;height:400px;object-fit:cover;">
                </div>

                {{-- Meta --}}
                <div class="flex align-center gap-16 mb-20" style="flex-wrap:wrap;">
                    <span class="flex align-center gap-6 fs-13 text-color-3">
                        <i class="icon-autodeal-user"></i> {{ $post['author'] }}
                    </span>
                    <span class="flex align-center gap-6 fs-13 text-color-3">
                        <i class="icon-autodeal-calendar"></i> {{ $post['date'] }}
                    </span>
                    <span class="category text-color-3 fs-13">{{ $post['category'] }}</span>
                </div>

                {{-- Body --}}
                <div class="post-content" style="font-size:16px;line-height:1.8;color:#374151;">
                    {!! $post['body'] !!}
                </div>

                {{-- Share --}}
                <div style="margin-top:32px;padding-top:24px;border-top:1px solid #e8ecf0;">
                    <p class="fw-6 mb-12">Share this article:</p>
                    <div class="flex gap-12">
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($post['title']) }}&url={{ url()->current() }}"
                           target="_blank" rel="noopener"
                           style="background:#1da1f2;color:#fff;padding:8px 20px;border-radius:6px;font-size:13px;text-decoration:none;">
                            Twitter / X
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($post['title'] . ' - ' . url()->current()) }}"
                           target="_blank" rel="noopener"
                           style="background:#25d366;color:#fff;padding:8px 20px;border-radius:6px;font-size:13px;text-decoration:none;">
                            WhatsApp
                        </a>
                    </div>
                </div>

            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4 mt-32 mt-lg-0">

                {{-- Related Posts --}}
                <div style="background:#f8fafc;border-radius:12px;padding:24px;border:1px solid #e8ecf0;">
                    <h5 class="fw-7 mb-20">Related Articles</h5>
                    @foreach($related as $rel)
                    <div style="display:flex;gap:14px;margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid #e8ecf0;">
                        <img src="{{ asset($rel['image']) }}" alt="{{ $rel['title'] }}"
                             style="width:80px;height:60px;object-fit:cover;border-radius:8px;flex-shrink:0;">
                        <div>
                            <a href="{{ route('blog.show', $rel['slug']) }}" wire:navigate
                               style="font-size:14px;font-weight:600;color:#1a202c;text-decoration:none;line-height:1.4;display:block;">
                                {{ $rel['title'] }}
                            </a>
                            <span class="fs-12 text-color-3">{{ $rel['date'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- CTA --}}
                <div style="background:var(--primary,#1a202c);border-radius:12px;padding:28px;margin-top:24px;text-align:center;">
                    <h5 style="color:#fff;margin-bottom:10px;">Ready to Buy or Sell?</h5>
                    <p style="color:rgba(255,255,255,0.7);font-size:14px;margin-bottom:20px;">
                        Browse thousands of verified cars in Kenya or list yours today.
                    </p>
                    <a href="{{ route('cars.index') }}" wire:navigate class="sc-button" style="display:block;margin-bottom:10px;">
                        Browse Cars
                    </a>
                    <a href="{{ route('my-listings.create') }}" wire:navigate
                       style="color:rgba(255,255,255,0.7);font-size:13px;text-decoration:none;">
                        + List Your Car
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
