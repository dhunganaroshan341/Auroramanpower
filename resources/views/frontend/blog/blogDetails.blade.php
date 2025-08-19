@extends('frontend.layouts.layout')

@php
    $title = $content_title ?? 'Blog Details';
    $subTitle = $content_title ?? 'Blog Details';
    $css =
        '<link href="' .
        asset('assets/css/module-css/page-title.css') .
        '" rel="stylesheet">
            <link href="' .
        asset('assets/css/module-css/news.css') .
        '" rel="stylesheet">
            <link href="' .
        asset('assets/css/module-css/blog-sidebar.css') .
        '" rel="stylesheet">
            <link href="' .
        asset('assets/css/module-css/blog-details.css') .
        '" rel="stylesheet">
            <link href="' .
        asset('assets/css/module-css/subscribe.css') .
        '" rel="stylesheet">
            <link href="' .
        asset('assets/css/module-css/footer.css') .
        '" rel="stylesheet">';
@endphp

@section('content')

    <section class="sidebar-page-container p_relative pt_110 pb_120">
        <div class="auto-container">
            <div class="row clearfix">
                <!-- Sidebar -->
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="blog-sidebar mr_40 mb_30">
                        <!-- Search -->
                        <div class="search-widget mb_60">
                            <div class="search-form">
                                <form method="post" action="{{ route('blog') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="search" name="search-field" placeholder="Search" required>
                                        <button type="submit"><i class="icon-1"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Categories -->
                        <div class="sidebar-widget category-widget mb_50">
                            <div class="widget-title mb_11">
                                <h3>Categories</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="category-list clearfix">
                                    @foreach ($categories as $category)
                                        <li>
                                            <a href="{{ route('blog', ['category' => $category->id]) }}">
                                                {{ $category->name }} <span>({{ $category->posts_count }})</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- Latest Posts -->
                        <div class="sidebar-widget post-widget mb_60">
                            <div class="widget-title mb_20">
                                <h3>Latest Posts</h3>
                            </div>
                            <div class="post-inner">
                                @foreach ($recentPosts as $recent)
                                    <div class="post">
                                        <figure class="post-thumb">
                                            <a href="{{ route('blogDetail', $recent->slug) }}">
                                                <img src="{{ $recent->firstImageUrl }}" alt="{{ $recent->title }}">
                                            </a>
                                        </figure>
                                        <h6><a
                                                href="{{ route('blogDetail', $recent->slug) }}">{{ Str::limit($recent->title, 50) }}</a>
                                        </h6>
                                        <span class="post-date">{{ $recent->created_at->format('j M Y') }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Tags -->
                        @if ($tags->isNotEmpty())
                            <div class="sidebar-widget tags-widget mb_45">
                                <div class="widget-title mb_20">
                                    <h3>Popular Tags</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="tags-list clearfix">
                                        @foreach ($tags as $tag)
                                            <li><a href="{{ route('blog', ['tag' => $tag->id]) }}">{{ $tag->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Blog Content -->
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="blog-details-content">
                        <div class="news-block-two">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ $post->firstImageUrl }}"
                                            alt="{{ $post->title }}"></figure>
                                </div>
                                <div class="lower-content">
                                    @if ($post->categories->isNotEmpty())
                                        <span class="category">{{ $post->categories->pluck('name')->join(', ') }}</span>
                                    @endif
                                    <h3>{{ $post->title }}</h3>
                                    <ul class="post-info">
                                        <li>By <a href="#">{{ $post->createdBy->name ?? 'Admin' }}</a></li>
                                        <li><span>{{ $post->created_at->format('j M Y') }}</span></li>
                                    </ul>
                                </div>
                                <div class="text-box pt_25 mb_50">
                                    {!! $post->description !!}
                                </div>
                            </div>
                        </div>

                        <!-- Related Posts -->
                        @if ($relatedPosts->isNotEmpty())
                            <div class="related-posts mb_50">
                                <h4>Related Posts</h4>
                                <div class="row clearfix">
                                    @foreach ($relatedPosts as $related)
                                        <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                                            <div class="news-block-two">
                                                <div class="inner-box">
                                                    <div class="image-box">
                                                        <figure class="image">
                                                            <a href="{{ route('blogDetail', $related->slug) }}">
                                                                <img src="{{ $related->firstImageUrl }}"
                                                                    alt="{{ $related->title }}">
                                                            </a>
                                                        </figure>
                                                    </div>
                                                    <div class="lower-content">
                                                        <span
                                                            class="category">{{ $related->categories->pluck('name')->join(', ') }}</span>
                                                        <h5><a
                                                                href="{{ route('blogDetail', $related->slug) }}">{{ Str::limit($related->title, 50) }}</a>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Navigation -->
                        <div class="post-navigation mt_50">
                            @if ($previousPost)
                                <a href="{{ route('blogDetail', $previousPost->slug) }}" class="prev-post">Previous:
                                    {{ Str::limit($previousPost->title, 30) }}</a>
                            @endif
                            @if ($nextPost)
                                <a href="{{ route('blogDetail', $nextPost->slug) }}" class="next-post">Next:
                                    {{ Str::limit($nextPost->title, 30) }}</a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
