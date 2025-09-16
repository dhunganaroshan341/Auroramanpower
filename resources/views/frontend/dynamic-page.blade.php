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
    <Section>
        {!! $content->content ?? '' !!}
    </Section>
@endsection
