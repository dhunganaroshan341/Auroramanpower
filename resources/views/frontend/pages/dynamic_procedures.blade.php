@extends('frontend.layouts.layout')

@php
    $css =
        '<link href="' .
        asset('assets/css/module-css/page-title.css') .
        '" rel="stylesheet">
            <link href="' .
        asset('assets/css/module-css/service-details.css') .
        '" rel="stylesheet">
            <link href="' .
        asset('assets/css/module-css/subscribe.css') .
        '" rel="stylesheet">
            <link href="' .
        asset('assets/css/module-css/footer.css') .
        '" rel="stylesheet">';
    $title = $title ?? 'Required Documents';
    $subTitle = $subTitle ?? 'Procedures';

@endphp

@section('content')
    <!-- service-details -->
    <section class="service-details pt_110 pb_120">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Sidebar -->
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="service-sidebar mr_40">
                        <div class="category-widget mb_40">
                            <ul class="category-list clearfix">
                                <li><a href="{{ route('required-documents') }}" class="{{(isRoute('required-documents'))?'current':''}}">Required Documents <i
                                            class="icon-42"></i></a></li>
                                <li><a href="{{ route('recruitment-process') }}" class = "class="{{(route('required-documents'))?'current':''}}">Recruitment Process <i
                                            class="icon-42"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

               {!! $content->content !!}

            </div>
        </div>
    </section>
    <!-- service-details end -->
@endsection
