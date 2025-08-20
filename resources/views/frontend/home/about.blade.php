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
                                        src="{{ asset('assets/images/resource/about-3.jpg') }}" alt=""></figure>
                                <figure class="image image-2"><img src="{{ asset('assets/images/resource/about-4.jpg') }}"
                                        alt=""></figure>
                            </div>
                            <div class="image-box">
                                <figure class="image image-3 mb_15"><img
                                        src="{{ asset('assets/images/resource/about-5.jpg') }}" alt=""></figure>
                                <figure class="image image-4"><img src="{{ asset('assets/images/resource/about-6.jpg') }}"
                                        alt=""></figure>
                            </div>
                            <div class="support-box">
                                <div class="icon-box"><i class="icon-support"></i></div>
                                <span>Online Support</span>
                                <h4><a href="tel:912556889">+912 (556) 889</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_five">
                        <div class="content-box">
                            <div class="sec-title pb_40 sec-title-animation animation-style2">
                                <span class="sub-title mb_10 title-animation">About us</span>
                                <h2 class="title-animation">The most loved <span>Agency</span></h2>
                                <p class="title-animation">Voted the fastest solution to implement the easiest way to
                                    administer your employee & business.</p>
                            </div>
                            <div class="inner-box clearfix">
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-speed"></i></div>
                                    <h4><a href="{{ route('jobDetails') }}">Easiest Admin</a></h4>
                                    <span>Fall 2023</span>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-heart"></i></div>
                                    <h4><a href="{{ route('jobDetails') }}">Users Love Us</a></h4>
                                    <span>Winter 2023</span>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-leader"></i></div>
                                    <h4><a href="{{ route('jobDetails') }}">Leader</a></h4>
                                    <span>Winter 2023</span>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-support"></i></div>
                                    <h4><a href="{{ route('jobDetails') }}">Best Support</a></h4>
                                    <span>Winter 2023</span>
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
                                src="{{ asset('assets/images/clients/clients-1.png') }}" alt=""></a></figure>
                    <figure class="overlay-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-1.png') }}" alt=""></a></figure>
                </div>
                <div class="clients-box">
                    <figure class="clients-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-2.png') }}" alt=""></a></figure>
                    <figure class="overlay-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-2.png') }}" alt=""></a></figure>
                </div>
                <div class="clients-box">
                    <figure class="clients-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-3.png') }}" alt=""></a></figure>
                    <figure class="overlay-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-3.png') }}" alt=""></a></figure>
                </div>
                <div class="clients-box">
                    <figure class="clients-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-4.png') }}" alt=""></a></figure>
                    <figure class="overlay-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-4.png') }}" alt=""></a></figure>
                </div>
                <div class="clients-box">
                    <figure class="clients-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-5.png') }}" alt=""></a></figure>
                    <figure class="overlay-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-5.png') }}" alt=""></a></figure>
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
                <h2 class="title-animation">Why Choose Us</h2>
            </div>
            <div class="inner-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                        <div class="chooseus-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-speed"></i></div>
                                <h3><a href="{{ route('index') }}">Retain Top Talent</a></h3>
                                <p>Providing clear career paths and growth opportunities is key to retaining top talent.</p>
                                <div class="link"><a href="{{ route('index') }}">Learn More<i class="icon-7"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                        <div class="chooseus-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-compliance"></i></div>
                                <h3><a href="{{ route('index') }}">Stay Compliant</a></h3>
                                <p>Educate employees about compliance requirements through regular training</p>
                                <div class="link"><a href="{{ route('index') }}">Learn More<i class="icon-7"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                        <div class="chooseus-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-growth"></i></div>
                                <h3><a href="{{ route('index') }}">Improve Employees</a></h3>
                                <p>Invest in employee training and development programs to enhance skills and knowledge.</p>
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

    <!-- industries-style-four -->
    <section class="industries-style-four pt_120 pb_90">
        <div class="auto-container">
            <div class="sec-title centred pb_60 sec-title-animation animation-style2">
                <span class="sub-title mb_10 title-animation">Categories</span>
                <h2 class="title-animation">Industries Served</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                    <div class="industries-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-hotel"></i></div>
                            <h3><a href="{{ route('index') }}">Hotel</a></h3>
                            <p>2853 Staffs</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                    <div class="industries-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-hospitality"></i></div>
                            <h3><a href="{{ route('index') }}">Hospitality</a></h3>
                            <p>2256 Staffs</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                    <div class="industries-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-kitchen"></i></div>
                            <h3><a href="{{ route('index') }}">Kitchen</a></h3>
                            <p>1408 Staffs</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                    <div class="industries-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-retail"></i></div>
                            <h3><a href="{{ route('index') }}">Retail</a></h3>
                            <p>1740 Staffs</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                    <div class="industries-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-events"></i></div>
                            <h3><a href="{{ route('index') }}">Events</a></h3>
                            <p>3948 Staffs</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                    <div class="industries-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-labor"></i></div>
                            <h3><a href="{{ route('index') }}">Labor</a></h3>
                            <p>2984 Staffs</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                    <div class="industries-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-driving"></i></div>
                            <h3><a href="{{ route('index') }}">Driving</a></h3>
                            <p>4509 Staffs</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                    <div class="industries-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-caretaker"></i></div>
                            <h3><a href="{{ route('index') }}">Caretaker</a></h3>
                            <p>1039 Staffs</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- industries-style-four end -->

    <!-- team-section -->
    <section class="team-section z_1 centred pt_0 pb_0">
        <!-- Existing Team Section -->
    </section>
    <!-- team-section end -->

    <!-- testimonial-style-two -->
    <section class="testimonial-style-two pt_70 pb_120">
        <!-- Existing Testimonial Section -->
    </section>
    <!-- testimonial-style-two end -->
@endsection
