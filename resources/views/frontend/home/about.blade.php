@extends('frontend.layouts.layout')

@php
    $title = 'About Us';
    $subTitle = 'About Us';
    $css =
        '<link href="' .
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
        '" rel="stylesheet">';
@endphp

@section('content')
    <!-- about-style-four -->
    <section class="about-style-four pt_120 pb_120">
        <div class="auto-container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image_block_two">
                        <div class="image-inner">
                            <div class="image-box mr_15">
                                <figure class="image image-1 mb_15"><img
                                        src="{{ asset('assets/images/resource/about-aurora-1.jpg') }}" alt="">
                                </figure>
                                <figure class="image image-2"><img
                                        src="{{ asset('assets/images/resource/about-aurora-2.jpg') }}" alt="">
                                </figure>
                            </div>
                            <div class="image-box">
                                <figure class="image image-3 mb_15"><img
                                        src="{{ asset('assets/images/resource/about-aurora-3.jpg') }}" alt="">
                                </figure>
                                <figure class="image image-4"><img
                                        src="{{ asset('assets/images/resource/about-aurora-4.jpg') }}" alt="">
                                </figure>
                            </div>
                            <div class="support-box">
                                <div class="icon-box"><i class="icon-28"></i></div>
                                <span>Online Support</span>
                                <h4><a href="tel:+977123456789">+977 123 456 789</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_five">
                        <div class="content-box">
                            <div class="sec-title pb_40 sec-title-animation animation-style2">
                                <span class="sub-title mb_10 title-animation">About us</span>
                                <h2 class="title-animation">Aurora <span>Nepal</span> HR</h2>
                                <p class="title-animation">Providing top HR solutions and recruitment services in Nepal.</p>
                            </div>
                            <div class="inner-box clearfix">
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-29"></i></div>
                                    <h4><a href="{{ route('jobDetails') }}">Talent Acquisition</a></h4>
                                    <span>2025</span>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-30"></i></div>
                                    <h4><a href="{{ route('jobDetails') }}">Employee Management</a></h4>
                                    <span>2025</span>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-31"></i></div>
                                    <h4><a href="{{ route('jobDetails') }}">Leadership Consulting</a></h4>
                                    <span>2025</span>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-32"></i></div>
                                    <h4><a href="{{ route('jobDetails') }}">Support Services</a></h4>
                                    <span>2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-style-four end -->

    <!-- clients-section -->
    <section class="clients-section home-3">
        <div class="bg-color"></div>
        <div class="auto-container">
            <div class="inner-container">
                <div class="clients-box">
                    <figure class="clients-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-aurora-1.png') }}" alt=""></a></figure>
                    <figure class="overlay-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-aurora-1.png') }}" alt=""></a>
                    </figure>
                </div>
                <div class="clients-box">
                    <figure class="clients-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-aurora-2.png') }}" alt=""></a>
                    </figure>
                    <figure class="overlay-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-aurora-2.png') }}" alt=""></a>
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <!-- clients-section end -->

    <!-- chooseus-section -->
    <section class="chooseus-section alternat-3 pt_120 pb_90">
        <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-23.png') }}')"></div>
        <div class="auto-container">
            <div class="sec-title light centred pb_60 sec-title-animation animation-style2">
                <span class="sub-title mb_10 title-animation">Why Us</span>
                <h2 class="title-animation">Why Choose Aurora Nepal</h2>
            </div>
            <div class="inner-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                        <div class="chooseus-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-4"></i></div>
                                <h3><a href="{{ route('index') }}">Top Talent</a></h3>
                                <p>Helping companies in Nepal find and retain the best talent.</p>
                                <div class="link"><a href="{{ route('index') }}">Learn More<i class="icon-7"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                        <div class="chooseus-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-5"></i></div>
                                <h3><a href="{{ route('index') }}">Compliance</a></h3>
                                <p>Ensuring HR processes comply with Nepalese regulations.</p>
                                <div class="link"><a href="{{ route('index') }}">Learn More<i class="icon-7"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                        <div class="chooseus-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-6"></i></div>
                                <h3><a href="{{ route('index') }}">Employee Growth</a></h3>
                                <p>Providing training and development programs for employees.</p>
                                <div class="link"><a href="{{ route('index') }}">Learn More<i class="icon-7"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- chooseus-section end -->
@endsection
