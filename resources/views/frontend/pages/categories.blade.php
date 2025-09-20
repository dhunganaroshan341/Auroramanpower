@extends('frontend.layouts.layout')

@php
    $css =
        '<link href="' .
        asset('assets/css/module-css/page-title.css') .
        '" rel="stylesheet">
            <link href="' .
        asset('assets/css/module-css/service.css') .
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
    $title = 'Job Categories';
    $subTitle = 'Our Categories';
@endphp

@section('content')
    <!-- service-section -->
    <section class="service-section centred pt_110 pb_90">
        <div class="auto-container">
            <div class="sec-title pb_60 sec-title-animation animation-style2">
                <span class="sub-title mb_10 title-animation">Explore Our Categories</span>
                <h2 class="title-animation">Recruitment Opportunities</h2>
                <p class="title-animation">Aurora Human Resource connects skilled professionals to their ideal roles across
                    industries.</p>
            </div>
            <div class="row clearfix">

                <!-- Logistics -->
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="{{ asset('assets/images/engineer.png') }}" alt="Logistics">
                                </figure>
                            </div>
                            <div class="lower-content">
                                <h3>Logistics</h3>
                                <p>Drivers, Trailer, Crane Operators, Excavator Operators, Mechanics (Diesel & Petrol)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Construction Engineer -->
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="{{ asset('assets/images/engineer.png') }}"
                                        alt="Construction Engineer"></figure>
                            </div>
                            <div class="lower-content">
                                <h3>Construction Engineer</h3>
                                <p>Engineers, Surveyor, Quantity Surveyor, Safety Officers, Supervisors, Foreman,
                                    Electricians, Masons, Carpenters, Helpers, and more.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hospitality Sector -->
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="{{ asset('assets/images/engineer.png') }}"
                                        alt="Hospitality"></figure>
                            </div>
                            <div class="lower-content">
                                <h3>Hospitality Sector</h3>
                                <p>Managers, Accountants, Secretaries, Waiters, Cooks, Cashiers, Housekeepers, Marketing
                                    Executives, and more.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Technician -->
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="{{ asset('assets/images/engineer.png') }}"
                                        alt="Technician"></figure>
                            </div>
                            <div class="lower-content">
                                <h3>Technician</h3>
                                <p>Plant Technician, Chiller Plant Technician, A/C Technician, Materials & Concrete
                                    Technician, Duct Technician.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Guards -->
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="{{ asset('assets/images/engineer.png') }}"
                                        alt="Security Guards"></figure>
                            </div>
                            <div class="lower-content">
                                <h3>Security Guards</h3>
                                <p>Security Officers, Supervisors, Guards, Watchmen, and other security personnel.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Manufacturing Sector -->
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="{{ asset('assets/images/engineer.png') }}"
                                        alt="Manufacturing"></figure>
                            </div>
                            <div class="lower-content">
                                <h3>Manufacturing Sector</h3>
                                <p>Production Operators, Factory Labour, and related manufacturing roles.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- service-section end -->
@endsection
