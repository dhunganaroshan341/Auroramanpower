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
                                        src="{{ asset('assets/images/resource/about-3.jpg') }}" alt="Aurora About Image 1">
                                </figure>
                                <figure class="image image-2"><img src="{{ asset('assets/images/resource/about-4.jpg') }}"
                                        alt="Aurora About Image 2"></figure>
                            </div>
                            <div class="image-box">
                                <figure class="image image-3 mb_15"><img
                                        src="{{ asset('assets/images/resource/about-5.jpg') }}" alt="Aurora About Image 3">
                                </figure>
                                <figure class="image image-4"><img src="{{ asset('assets/images/resource/about-6.jpg') }}"
                                        alt="Aurora About Image 4"></figure>
                            </div>
                            <div class="support-box">
                                <div class="icon-box"><i class="icon-support"></i></div>
                                <span>Online Support</span>
                                <h4><a href="tel:+912556889">+912 (556) 889</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_five">
                        <div class="content-box">
                            <div class="sec-title pb_40 sec-title-animation animation-style2">
                                <span class="sub-title mb_10 title-animation">About Aurora</span>
                                <h2 class="title-animation">Delivering <span>Innovative Solutions</span></h2>
                                <p class="title-animation">Aurora is dedicated to providing smart, seamless, and scalable
                                    solutions
                                    for businesses looking to enhance productivity, efficiency, and digital presence.</p>
                            </div>
                            <div class="inner-box clearfix">
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-speed"></i></div>
                                    <h4><a href="{{ route('jobDetails') }}">Fast Deployment</a></h4>
                                    <span>2025</span>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-heart"></i></div>
                                    <h4><a href="{{ route('jobDetails') }}">Loved by Users</a></h4>
                                    <span>2025</span>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-leader"></i></div>
                                    <h4><a href="{{ route('jobDetails') }}">Industry Leader</a></h4>
                                    <span>2025</span>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-support"></i></div>
                                    <h4><a href="{{ route('jobDetails') }}">24/7 Support</a></h4>
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
                                src="{{ asset('assets/images/clients/clients-1.png') }}" alt="Client 1"></a></figure>
                    <figure class="overlay-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-1.png') }}" alt="Client 1"></a></figure>
                </div>
                <div class="clients-box">
                    <figure class="clients-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-2.png') }}" alt="Client 2"></a></figure>
                    <figure class="overlay-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-2.png') }}" alt="Client 2"></a></figure>
                </div>
                <div class="clients-box">
                    <figure class="clients-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-3.png') }}" alt="Client 3"></a></figure>
                    <figure class="overlay-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-3.png') }}" alt="Client 3"></a></figure>
                </div>
                <div class="clients-box">
                    <figure class="clients-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-4.png') }}" alt="Client 4"></a></figure>
                    <figure class="overlay-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-4.png') }}" alt="Client 4"></a></figure>
                </div>
                <div class="clients-box">
                    <figure class="clients-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-5.png') }}" alt="Client 5"></a></figure>
                    <figure class="overlay-logo"><a href="{{ route('index') }}"><img
                                src="{{ asset('assets/images/clients/clients-5.png') }}" alt="Client 5"></a></figure>
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
                <h2 class="title-animation">Why Choose Aurora</h2>
            </div>
            <div class="inner-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                        <div class="chooseus-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-talent"></i></div>
                                <h3><a href="{{ route('index') }}">Top Talent Retention</a></h3>
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
                                <h3><a href="{{ route('index') }}">Regulatory Compliance</a></h3>
                                <p>Educate employees about compliance requirements through regular training.</p>
                                <div class="link"><a href="{{ route('index') }}">Learn More<i class="icon-7"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                        <div class="chooseus-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-growth"></i></div>
                                <h3><a href="{{ route('index') }}">Employee Growth</a></h3>
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

    <!-- categories-section -->
    <section class="industries-style-four pt_120 pb_90">
        <div class="auto-container">
            <div class="sec-title centred pb_60 sec-title-animation animation-style2">
                <span class="sub-title mb_10 title-animation">Categories</span>
                <h2 class="title-animation">Categories Served by Aurora</h2>
            </div>
            <div class="row clearfix">
                @php
                    $categories = [
                        ['name' => 'Hotel', 'staff' => 2853, 'icon' => 'icon-hotel'],
                        ['name' => 'Hospitality', 'staff' => 2256, 'icon' => 'icon-hospitality'],
                        ['name' => 'Kitchen', 'staff' => 1408, 'icon' => 'icon-kitchen'],
                        ['name' => 'Retail', 'staff' => 1740, 'icon' => 'icon-retail'],
                        ['name' => 'Events', 'staff' => 3948, 'icon' => 'icon-events'],
                        ['name' => 'Labor', 'staff' => 2984, 'icon' => 'icon-labor'],
                        ['name' => 'Driving', 'staff' => 4509, 'icon' => 'icon-driving'],
                        ['name' => 'Caretaker', 'staff' => 1039, 'icon' => 'icon-caretaker'],
                    ];
                @endphp
                @foreach ($categories as $category)
                    <div class="col-lg-3 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-two">
                            <div class="inner-box">
                                <div class="icon-box"><i class="{{ $category['icon'] }}"></i></div>
                                <h3><a href="{{ route('index') }}">{{ $category['name'] }}</a></h3>
                                <p>{{ $category['staff'] }} Staffs</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- categories-section end -->

    <!-- team-section -->
    <section class="team-section z_1 centred pt_0 pb_0">
        <!-- Keep your existing Team section unchanged -->
    </section>
    <!-- team-section end -->

    <!-- testimonial-style-two -->
    <section class="testimonial-style-two pt_70 pb_120">
        <!-- Keep your existing Testimonial section unchanged -->
    </section>
    <!-- testimonial-style-two end -->
@endsection
