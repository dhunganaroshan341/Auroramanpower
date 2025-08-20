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
                                        src="{{ asset('assets/images/resource/aurora-1.jpg') }}" alt="Aurora Team"></figure>
                                <figure class="image image-2"><img src="{{ asset('assets/images/resource/aurora-2.jpg') }}"
                                        alt="Aurora Work"></figure>
                            </div>
                            <div class="image-box">
                                <figure class="image image-3 mb_15"><img
                                        src="{{ asset('assets/images/resource/aurora-3.jpg') }}" alt="Aurora Office">
                                </figure>
                                <figure class="image image-4"><img src="{{ asset('assets/images/resource/aurora-4.jpg') }}"
                                        alt="Aurora Innovation"></figure>
                            </div>
                            <div class="support-box">
                                <div class="icon-box"><i class="icon-28"></i></div>
                                <span>Support Anytime</span>
                                <h4><a href="tel:+123456789">+123 (456) 789</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_five">
                        <div class="content-box">
                            <div class="sec-title pb_40 sec-title-animation animation-style2">
                                <span class="sub-title mb_10 title-animation">About Aurora</span>
                                <h2 class="title-animation">Innovation Meets <span>Creativity</span></h2>
                                <p class="title-animation">Aurora transforms ideas into digital experiences that inspire and
                                    engage audiences worldwide.</p>
                            </div>
                            <div class="inner-box clearfix">
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-29"></i></div>
                                    <h4><a href="{{ route('jobDetails') }}">Cutting-edge Solutions</a></h4>
                                    <span>2025</span>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-30"></i></div>
                                    <h4><a href="{{ route('jobDetails') }}">Loved by Clients</a></h4>
                                    <span>Global</span>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-31"></i></div>
                                    <h4><a href="{{ route('jobDetails') }}">Pioneering Team</a></h4>
                                    <span>2025</span>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-32"></i></div>
                                    <h4><a href="{{ route('jobDetails') }}">Reliable Support</a></h4>
                                    <span>24/7</span>
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
                @foreach (range(1, 5) as $i)
                    <div class="clients-box">
                        <figure class="clients-logo"><a href="{{ route('index') }}"><img
                                    src="{{ asset('assets/images/clients/aurora-client-' . $i . '.png') }}" alt=""></a>
                        </figure>
                        <figure class="overlay-logo"><a href="{{ route('index') }}"><img
                                    src="{{ asset('assets/images/clients/aurora-client-' . $i . '.png') }}" alt=""></a>
                        </figure>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- clients-section end -->

    <!-- chooseus-section -->
    <section class="chooseus-section alternat-3 pt_120 pb_90">
        <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/aurora-shape.png') }}')">
        </div>
        <div class="auto-container">
            <div class="sec-title light centred pb_60 sec-title-animation animation-style2">
                <span class="sub-title mb_10 title-animation">Why Aurora</span>
                <h2 class="title-animation">Why Choose Aurora</h2>
            </div>
            <div class="inner-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                        <div class="chooseus-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-4"></i></div>
                                <h3><a href="{{ route('index') }}">Innovation</a></h3>
                                <p>Transforming ideas into meaningful digital experiences that leave a mark.</p>
                                <div class="link"><a href="{{ route('index') }}">Learn More<i class="icon-7"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                        <div class="chooseus-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-5"></i></div>
                                <h3><a href="{{ route('index') }}">Global Impact</a></h3>
                                <p>Solutions that resonate with clients worldwide, driving growth and engagement.</p>
                                <div class="link"><a href="{{ route('index') }}">Learn More<i class="icon-7"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                        <div class="chooseus-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-6"></i></div>
                                <h3><a href="{{ route('index') }}">Trusted Team</a></h3>
                                <p>Our experienced team ensures projects are delivered on-time and beyond expectations.</p>
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

    <!-- team-section -->
    <section class="team-section z_1 centred pt_0 pb_0">
        <div class="auto-container">
            <div class="sec-title pb_60 sec-title-animation animation-style2">
                <span class="sub-title mb_10 title-animation">Aurora Team</span>
                <h2 class="title-animation">Meet Our Visionaries</h2>
            </div>
            <div class="row clearfix">
                @foreach (range(1, 4) as $i)
                    <div class="col-lg-3 col-md-6 col-sm-12 team-block">
                        <div class="team-block-one wow fadeInUp animated" data-wow-delay="{{ ($i - 1) * 200 }}ms"
                            data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img
                                            src="{{ asset('assets/images/team/aurora-team-' . $i . '.jpg') }}"
                                            alt=""></figure>
                                    <figure class="overlay-image"><img
                                            src="{{ asset('assets/images/team/aurora-team-' . $i . '.jpg') }}"
                                            alt=""></figure>
                                </div>
                                <div class="lower-content">
                                    <h3><a href="{{ route('index') }}">Member {{ $i }}</a></h3>
                                    <span class="designation">Position {{ $i }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- team-section end -->

    <!-- testimonial-style-two -->
    <section class="testimonial-style-two pt_70 pb_120">
        <div class="pattern-layer"
            style="background-image: url('{{ asset('assets/images/shape/aurora-testimonial-shape.png') }}')"></div>
        <div class="auto-container">
            <div class="sec-title centred pb_60 sec-title-animation animation-style2">
                <span class="sub-title mb_10 title-animation">Testimonials</span>
                <h2 class="title-animation">What Clients Say</h2>
            </div>
            <div class="two-item-carousel owl-carousel owl-theme owl-nav-none">
                @foreach (range(1, 4) as $i)
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><img src="{{ asset('assets/images/icons/aurora-quote.png') }}"
                                    alt=""></div>
                            <div class="author-box">
                                <figure class="thumb-box"><img
                                        src="{{ asset('assets/images/resource/aurora-testimonial-' . $i . '.png') }}"
                                        alt=""></figure>
                                <h4>Client {{ $i }}</h4>
                                <span class="designation">CEO, Company {{ $i }}</span>
                            </div>
                            <p>Aurora delivered beyond expectations, blending creativity and technology seamlessly.</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- testimonial-style-two end -->
@endsection
