@extends('frontend.layouts.layout')

@php
    $css =
        '
    <link href="' .
        asset('assets/css/module-css/page-title.css') .
        '" rel="stylesheet">
    <link href="' .
        asset('assets/css/module-css/about.css') .
        '" rel="stylesheet">
    <link href="' .
        asset('assets/css/module-css/clients.css') .
        '" rel="stylesheet">
    <link href="' .
        asset('assets/css/module-css/chooseus.css') .
        '" rel="stylesheet">
    <link href="' .
        asset('assets/css/module-css/industries.css') .
        '" rel="stylesheet">
    <link href="' .
        asset('assets/css/module-css/team.css') .
        '" rel="stylesheet">
    <link href="' .
        asset('assets/css/module-css/testimonial.css') .
        '" rel="stylesheet">
    <link href="' .
        asset('assets/css/module-css/subscribe.css') .
        '" rel="stylesheet">
    <link href="' .
        asset('assets/css/module-css/footer.css') .
        '" rel="stylesheet">
    ';

    $title = $content->title ?? 'Aurora Nepal';

    // If dynamic title exists, check for subtitle
    if (!empty($content->title)) {
        $subTitle = $content->content_sub_heading ?? $title;
    } else {
        $subTitle = "Nepal's leading manpower company";
    }
@endphp

@section('content')
    <!-- Chairman's Message Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-stretch">

                <!-- Chairman Message (Left) -->
                <div class="col-md-8 d-flex">
                    <div class="my-auto text-muted" style="line-height: 1.8;">
                        {!! $content->content !!}
                    </div>
                </div>

                <!-- Chairman Image (Right) -->
                <div class="col-md-4 d-flex">
                    <div class="my-auto w-100 text-center">
                        <img src="{{ $content->image1 }}" alt="Chairman" class="img-fluid rounded shadow-lg h-100"
                            style="object-fit: cover; max-height: 100%;">
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
