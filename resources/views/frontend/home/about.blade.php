@extends('frontend.layouts.layout')

@php
    $title='About Us';
    $subTitle='About Us';
    $css = '<link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/about.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/clients.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/chooseus.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/industries.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/team.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/testimonial.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
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
                            <figure class="image image-1 mb_15"><img src="{{ asset('assets/images/resource/about-3.jpg') }}" alt=""></figure>
                            <figure class="image image-2"><img src="{{ asset('assets/images/resource/about-4.jpg') }}" alt=""></figure>
                        </div>
                        <div class="image-box">
                            <figure class="image image-3 mb_15"><img src="{{ asset('assets/images/resource/about-5.jpg') }}" alt=""></figure>
                            <figure class="image image-4"><img src="{{ asset('assets/images/resource/about-6.jpg') }}" alt=""></figure>
                        </div>
                        <div class="support-box">
                            <div class="icon-box"><i class="icon-28"></i></div>
                            <span>Online Support</span>
                            <h4><a href="tel:+977123456789">+977 123456789</a></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                <div class="content_block_five">
                    <div class="content-box">
                        <div class="sec-title pb_40 sec-title-animation animation-style2">
                            <span class="sub-title mb_10 title-animation">About Us</span>
                            <h2 class="title-animation">Aurora Human Resource <span>(P) Ltd.</span></h2>
                            <p class="title-animation">
                                Aurora Human Resource (P) Ltd. is one of Nepal’s pioneer international manpower agencies,
                                committed to offering true customer-focused recruitment solutions. With over 10,000 skilled,
                                semi-skilled, and unskilled workers successfully deployed to Asia, Europe, and the Gulf countries,
                                we have built a strong reputation as a trusted manpower partner.
                            </p>
                        </div>
                        <div class="inner-box clearfix">
                            <div class="single-item">
                                <div class="icon-box"><i class="icon-29"></i></div>
                                <h4>Our Mission</h4>
                                <span>
                                    To connect screened and deserving candidates with reputed employers worldwide,
                                    ensuring cost-effective, value-added, and long-term recruitment solutions.
                                </span>
                            </div>
                            <div class="single-item">
                                <div class="icon-box"><i class="icon-30"></i></div>
                                <h4>Our Vision</h4>
                                <span>
                                    To contribute in reducing unemployment by deploying Nepalese manpower abroad
                                    and building reliable global partnerships.
                                </span>
                            </div>
                            <div class="single-item">
                                <div class="icon-box"><i class="icon-31"></i></div>
                                <h4>Our Objective</h4>
                                <span>
                                    To provide opportunities for Nepalese citizens to earn a decent living abroad while
                                    contributing to Nepal’s economy through remittances.
                                </span>
                            </div>
                            <div class="single-item">
                                <div class="icon-box"><i class="icon-32"></i></div>
                                <h4>Our Policy</h4>
                                <span>
                                    We strictly follow the guidelines of Nepal’s Foreign Employment Act and host
                                    country labor laws, prioritizing human rights, compliance, and worker welfare.
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about-style-four end -->


        <!-- team-section -->
        <section class="team-section z_1 centred pt_0 pb_0">
            <div class="auto-container">
                <div class="sec-title pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Our Team</span>
                    <h2 class="title-animation">Meet The Team</h2>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12 team-block">
                        <div class="team-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset('assets/images/team/team-1.jpg') }}" alt=""></figure>
                                    <figure class="overlay-image"><img src="{{ asset('assets/images/team/team-1.jpg') }}" alt=""></figure>
                                </div>
                                <div class="lower-content">
                                    <h3><a href="{{ route('index') }}">Tom Oliver</a></h3>
                                    <span class="designation">Founder</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 team-block">
                        <div class="team-block-one wow fadeInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset('assets/images/team/team-2.jpg') }}" alt=""></figure>
                                    <figure class="overlay-image"><img src="{{ asset('assets/images/team/team-2.jpg') }}" alt=""></figure>
                                </div>
                                <div class="lower-content">
                                    <h3><a href="{{ route('index') }}">Loenard Barnes</a></h3>
                                    <span class="designation">Lead Engineer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 team-block">
                        <div class="team-block-one wow fadeInUp animated" data-wow-delay="400ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset('assets/images/team/team-3.jpg') }}" alt=""></figure>
                                    <figure class="overlay-image"><img src="{{ asset('assets/images/team/team-3.jpg') }}" alt=""></figure>
                                </div>
                                <div class="lower-content">
                                    <h3><a href="{{ route('index') }}">Gilbert Sherman</a></h3>
                                    <span class="designation">Sale Manager</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 team-block">
                        <div class="team-block-one wow fadeInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset('assets/images/team/team-4.jpg') }}" alt=""></figure>
                                    <figure class="overlay-image"><img src="{{ asset('assets/images/team/team-4.jpg') }}" alt=""></figure>
                                </div>
                                <div class="lower-content">
                                    <h3><a href="{{ route('index') }}">Franklin Bailey</a></h3>
                                    <span class="designation">Art Director</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- team-section end -->

        <!-- testimonial-style-two -->
        <section class="testimonial-style-two pt_70 pb_120">
            <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-17.png') }}')"></div>
            <div class="auto-container">
                <div class="sec-title centred pb_60 sec-title-animation animation-style2">
                    <span class="sub-title mb_10 title-animation">Testimonials</span>
                    <h2 class="title-animation">Love From Users</h2>
                </div>
                <div class="two-item-carousel owl-carousel owl-theme owl-nav-none">
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-11.png') }}" alt=""></div>
                            <div class="author-box">
                                <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-1.png') }}" alt=""></figure>
                                <h4>Evan Clement</h4>
                                <span class="designation">HR Assistant, NFL</span>
                            </div>
                            <p>Company and was impressed by the personalized approach of their recruitment team. They kept me informed at every stage and ensured that I had all the information I needed to succeed.</p>
                        </div>
                    </div>
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-11.png') }}" alt=""></div>
                            <div class="author-box">
                                <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-3.png') }}" alt=""></figure>
                                <h4>Maharan Depaak</h4>
                                <span class="designation">CEO, Amaban</span>
                            </div>
                            <p>Recently I went through their recruitment process with Jobaway Company, and I was impressed by how the smooth and efficient these were.</p>
                        </div>
                    </div>
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-11.png') }}" alt=""></div>
                            <div class="author-box">
                                <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-1.png') }}" alt=""></figure>
                                <h4>Evan Clement</h4>
                                <span class="designation">HR Assistant, NFL</span>
                            </div>
                            <p>Company and was impressed by the personalized approach of their recruitment team. They kept me informed at every stage and ensured that I had all the information I needed to succeed.</p>
                        </div>
                    </div>
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-11.png') }}" alt=""></div>
                            <div class="author-box">
                                <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-3.png') }}" alt=""></figure>
                                <h4>Maharan Depaak</h4>
                                <span class="designation">CEO, Amaban</span>
                            </div>
                            <p>Recently I went through their recruitment process with Jobaway Company, and I was impressed by how the smooth and efficient these were.</p>
                        </div>
                    </div>
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-11.png') }}" alt=""></div>
                            <div class="author-box">
                                <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-1.png') }}" alt=""></figure>
                                <h4>Evan Clement</h4>
                                <span class="designation">HR Assistant, NFL</span>
                            </div>
                            <p>Company and was impressed by the personalized approach of their recruitment team. They kept me informed at every stage and ensured that I had all the information I needed to succeed.</p>
                        </div>
                    </div>
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-11.png') }}" alt=""></div>
                            <div class="author-box">
                                <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-3.png') }}" alt=""></figure>
                                <h4>Maharan Depaak</h4>
                                <span class="designation">CEO, Amaban</span>
                            </div>
                            <p>Recently I went through their recruitment process with Jobaway Company, and I was impressed by how the smooth and efficient these were.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- testimonial-style-two end -->

@endsection
