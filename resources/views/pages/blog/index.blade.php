@extends('layouts.app')
@section('title', 'Blog — AutoVault Kenya')

@section('content')

<section class="tf-banner style-2">
    <div class="container">
        <div class="heading">
            <h2 class="text-color-1">AutoVault Blog</h2>
            <p class="text-color-1 fs-16 fw-4">Car buying guides, reviews &amp; tips for Kenyan buyers</p>
        </div>
    </div>
</section>

<section class="flat-section">
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
            <div class="col-lg-6 col-xl-3 mb-30">
                <div class="blog-article-item style2 hover-img">
                    <div class="images img-style relative flex-none">
                        <img class="lazyload" data-src="{{ asset($post['image']) }}"
                             src="{{ asset($post['image']) }}" alt="{{ $post['title'] }}">
                        <div class="date">{{ $post['date'] }}</div>
                    </div>
                    <div class="content">
                        <div class="sub-box flex align-center fs-13 fw-6">
                            <a href="#" class="admin fw-7 text-color-2">{{ $post['author'] }}</a>
                            <a href="#" class="category text-color-3">{{ $post['category'] }}</a>
                        </div>
                        <h3><a href="{{ route('blog.show', $post['slug']) }}" wire:navigate>{{ $post['title'] }}</a></h3>
                        <p>{{ $post['excerpt'] }}</p>
                        <a href="{{ route('blog.show', $post['slug']) }}" wire:navigate class="read-more">Read more</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
