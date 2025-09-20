@extends('frontend.layouts.layout')

@php
    $title = 'Place Your Job';
    $subTitle = 'Hire';
    $css =
        '<link href="' .
        asset('assets/css/module-css/header.css') .
        '" rel="stylesheet">
            <link href="' .
        asset('assets/css/module-css/page-title.css') .
        '" rel="stylesheet">
            <link href="' .
        asset('assets/css/module-css/about.css') .
        '" rel="stylesheet">
            <link href="' .
        asset('assets/css/module-css/job.css') .
        '" rel="stylesheet">
            <link href="' .
        asset('assets/css/module-css/clients.css') .
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
    <!-- job-form-section -->
    <section class="job-form-section pt_120 pb_120">
        <div class="auto-container">
            <div class="sec-title centred pb_70 light sec-title-animation animation-style2">
                <span class="sub-title mb_10 title-animation">REQUEST NEEDED TALENT</span>
                <h2 class="title-animation">Talented Professionals Needed</h2>
                <p class="title-animation">We are on the lookout for talented professionals who are eager to contribute to
                    our <br />innovative and dynamic team.</p>
            </div>
            <form method="post" action="{{ route('job') }}">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 form-column">
                        <div class="form-inner">
                            <div class="title-box">
                                <div class="icon-box"><i class="icon-39"></i></div>
                                <h3>Contact Person</h3>
                                <p>Please fill out your contact person details here.</p>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="fname" placeholder="First Name" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="lname" placeholder="Last Name" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="phone" placeholder="Phone" required>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <input type="text" name="address" placeholder="Address" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 form-column">
                        <div class="form-inner">
                            <div class="title-box">
                                <div class="icon-box"><i class="icon-40"></i></div>
                                <h3>Company Details</h3>
                                <p>Please fill out your contact person details here.</p>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="company_name" placeholder="Company Name" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="web_url" placeholder="Website" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <div class="select-box">
                                        <select class="wide">
                                            <option data-display="Industry">Industry</option>
                                            <option value="1">Executive</option>
                                            <option value="2">Training</option>
                                            <option value="3">Career</option>
                                            <option value="4">Payroll</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="phone" placeholder="Phone" required>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <input type="text" name="address" placeholder="Address" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 form-column">
                        <div class="form-inner">
                            <div class="row clearfix">
                                <div class="col-lg-7 col-md-12 col-sm-12 left-column">
                                    <div class="title-box">
                                        <div class="icon-box"><i class="icon-41"></i></div>
                                        <h3>Request Talent</h3>
                                        <p>Here you can leave your job details & Submit your job post.</p>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <div class="select-box">
                                                <select class="wide">
                                                    <option data-display="Specialisation">Specialisation</option>
                                                    <option value="1">Information technology</option>
                                                    <option value="2">Marketing</option>
                                                    <option value="3">Finance</option>
                                                    <option value="4">International trade</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <div class="select-box">
                                                <select class="wide">
                                                    <option data-display="Preferred Pronoun">Preferred Pronoun</option>
                                                    <option value="1">Information technology</option>
                                                    <option value="2">Marketing</option>
                                                    <option value="3">Finance</option>
                                                    <option value="4">International trade</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <input type="text" name="post" placeholder="Position hiring for" required>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <div class="select-box">
                                                <select class="wide">
                                                    <option data-display="Number of Opening">Number of Opening</option>
                                                    <option value="1">01</option>
                                                    <option value="2">02</option>
                                                    <option value="3">03</option>
                                                    <option value="4">04</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <input type="text" name="location" placeholder="Job Location" required>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <input type="text" name="rate" placeholder="Pay Rate Range" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-12 col-sm-12 right-column">
                                    <div class="right-content">
                                        <div class="form-group">
                                            <textarea name="message" placeholder="Job Description"></textarea>
                                        </div>
                                        <div class="form-group message-btn">
                                            <button type="submit" class="theme-btn btn-one">Submit Your Request</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- job-form-section end -->

    <!-- clients-style-two -->
    <section class="clients-style-two centred pt_110 pb_120">
        <div class="auto-container">
            <div class="title-text">
                <h3>Trusted by the next-gen industry leaders</h3>
            </div>
            <div class="clients-carousel owl-carousel owl-theme owl-dots-none owl-nav-none">
                <figure class="clients-logo"><a href="{{ route('index') }}"><img
                            src="{{ asset('assets/images/clients/clients-6.png') }}" alt=""></a></figure>
                <figure class="clients-logo"><a href="{{ route('index') }}"><img
                            src="{{ asset('assets/images/clients/clients-7.png') }}" alt=""></a></figure>
                <figure class="clients-logo"><a href="{{ route('index') }}"><img
                            src="{{ asset('assets/images/clients/clients-8.png') }}" alt=""></a></figure>
                <figure class="clients-logo"><a href="{{ route('index') }}"><img
                            src="{{ asset('assets/images/clients/clients-9.png') }}" alt=""></a></figure>
                <figure class="clients-logo"><a href="{{ route('index') }}"><img
                            src="{{ asset('assets/images/clients/clients-10.png') }}" alt=""></a></figure>
            </div>
        </div>
    </section>
    <!-- clients-style-two end -->

    <!-- testimonial-style-three -->
    <section class="testimonial-style-three pb_120">
        <div class="auto-container">
            <div class="inner-container">
                <div class="shape">
                    <div class="shape-1"></div>
                    <div class="shape-2"></div>
                </div>
                <div class="single-item-carousel owl-carousel owl-theme owl-dots-none nav-style-one">
                    <div class="testimonial-block">
                        <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-5.png') }}"
                                alt=""></figure>
                        <div class="content-box">
                            <div class="icon-box"><i class="icon-36"></i></div>
                            <h2>Company was impressed by the personal approach of their recruitment team for the
                                improvement. They kept informed at every stage of the task.</h2>
                            <h3>Franklin Bailey</h3>
                            <span class="designation">CEO, JobAway</span>
                        </div>
                    </div>
                    <div class="testimonial-block">
                        <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-5.png') }}"
                                alt=""></figure>
                        <div class="content-box">
                            <div class="icon-box"><i class="icon-36"></i></div>
                            <h2>Company was impressed by the personal approach of their recruitment team for the
                                improvement. They kept informed at every stage of the task.</h2>
                            <h3>Franklin Bailey</h3>
                            <span class="designation">CEO, JobAway</span>
                        </div>
                    </div>
                    <div class="testimonial-block">
                        <figure class="thumb-box"><img src="{{ asset('assets/images/resource/testimonial-5.png') }}"
                                alt=""></figure>
                        <div class="content-box">
                            <div class="icon-box"><i class="icon-36"></i></div>
                            <h2>Company was impressed by the personal approach of their recruitment team for the
                                improvement. They kept informed at every stage of the task.</h2>
                            <h3>Franklin Bailey</h3>
                            <span class="designation">CEO, JobAway</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial-style-three end -->
@endsection
