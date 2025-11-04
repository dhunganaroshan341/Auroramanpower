@extends('frontend.layouts.layout')

@php
    $css = '
        <link href="' . asset("assets/css/module-css/page-title.css") . '" rel="stylesheet">
        <link href="' . asset("assets/css/module-css/subscribe.css") . '" rel="stylesheet">
        <link href="' . asset("assets/css/module-css/footer.css") . '" rel="stylesheet">
    ';
    $title = ' Page Not Available';
    $subTitle = 'Oops! Page not found.';
@endphp

@section('content')
<section class="py-5 text-center" style="min-height:70vh; display:flex; align-items:center; justify-content:center; flex-direction:column;">
    <div class="container">
        <h1 class="display-1 fw-bold text-danger">404</h1>
        <h2 class="mb-3">{{ $subTitle }}</h2>
        <p class="mb-4 text-muted">
            Sorry, the page you are looking for does not exist. <br>
            It might have been removed, had its name changed, or is temporarily unavailable.
        </p>
        <a href="{{ url('/') }}" class="theme-btn btn-one">
            Go Back Home
        </a>
    </div>
</section>
@endsection
