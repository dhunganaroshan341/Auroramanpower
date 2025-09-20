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
    $title = 'About Us';
    $subTitle = 'Company Overview';
@endphp

@section('content')
    <!-- service-details / company-overview -->
    <section class="service-details pt_110 pb_120">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Sidebar -->
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="service-sidebar mr_40">
                        <div class="category-widget mb_40">
                            <ul class="category-list clearfix">
                                <li><a href="{{ route('company-overview') }}"
                                        class="{{ request()->routeIs('company-overview') ? 'current' : '' }}">
                                        Company Overview <i class="icon-42"></i></a>
                                </li>

                                <li><a href="{{ route('message-from-chairman') }}"
                                        class="{{ request()->routeIs('message-from-chairman') ? 'current' : '' }}">
                                        Message from Chairman <i class="icon-42"></i></a>
                                </li>

                                <li><a href="{{ route('license-certificates') }}"
                                        class="{{ request()->routeIs('license-certificates') ? 'current' : '' }}">
                                        License & Certificates <i class="icon-42"></i></a>
                                </li>

                                <li><a href="{{ route('organizational-chart') }}"
                                        class="{{ request()->routeIs('organizational-chart') ? 'current' : '' }}">
                                        Organizational Chart <i class="icon-42"></i></a>
                                </li>

                            </ul>
                        </div>
                        <div class="download-widget">
                            <div class="shape"
                                style="background-image: url('{{ asset('assets/images/shape/shape-24.png') }}')"></div>
                            <div class="inner-box">
                                <figure class="image-box"><img src="{{ asset('assets/images/resource/book-3.png') }}"
                                        alt=""></figure>
                                <h4>The 2025 guide for Optimal Content <span>Management</span></h4>
                                <button type="button" class="theme-btn btn-one">Download E-book</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Side -->
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="service-details-content">

                        <!-- Introduction -->
                        <div class="sec-title mb_70">
                            <span class="sub-title mb_10">About Aurora HR</span>
                            <h2>Company Overview</h2>
                            <p class="mt_20">Aurora Human Resource (P) Ltd., an international manpower agency, is a pioneer
                                in manpower recruiting. Established with a core belief in providing true customer-focused
                                solutions, our team of highly dedicated and experienced professionals is backed with modern
                                resources and centrally located workplace at Kupondole, Lalitpur. We have successfully
                                deployed over 10,000 unskilled, semi-skilled, and skilled personnel across Asia, Europe, and
                                Gulf countries.</p>
                            <p>Our primary objective is to enable Nepali citizens to earn a decent living abroad while
                                contributing to Nepal’s economy through remittance and addressing unemployment.</p>
                        </div>

                        <figure class="image-box mb_30">
                            <img src="{{ asset('assets/images/company/company-overview.jpg') }}" alt="Aurora HR Office">
                        </figure>

                        <!-- Mission & Vision -->
                        <div class="row mb-5">
                            <!-- Mission -->
                            <div class="col-md-6 mb-4">
                                <div class="card text-center shadow border-0 h-100">
                                    <div class="card-body p-5">
                                        <div class="mb-3">
                                            <span
                                                class="d-inline-flex justify-content-center align-items-center bg-primary text-white rounded-circle"
                                                style="width:60px;height:60px;">
                                                <i class="fa fa-bullseye fa-lg"></i>
                                            </span>
                                        </div>
                                        <h4 class="fw-bold mb-3">Our Mission</h4>
                                        <p class="text-muted">
                                            To provide distinctive services by connecting screened, shortlisted, and
                                            deserving
                                            candidates with reputed employers, ensuring cost-effective and value-added
                                            services
                                            that maintain market goodwill and brand reputation.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Vision -->
                            <div class="col-md-6 mb-4">
                                <div class="card text-center shadow border-0 h-100">
                                    <div class="card-body p-5">
                                        <div class="mb-3">
                                            <span
                                                class="d-inline-flex justify-content-center align-items-center bg-danger text-white rounded-circle"
                                                style="width:60px;height:60px;">
                                                <i class="fas fa-eye fa-lg"></i>
                                            </span>
                                        </div>
                                        <h4 class="fw-bold mb-3">Our Vision</h4>
                                        <p class="text-muted">
                                            To build reliable connections abroad and help address unemployment in Nepal,
                                            while
                                            deploying potential Nepali manpower to the best international employers
                                            worldwide.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Objective -->
                        <div class="text-box mb_70">
                            <h2>Our Objective</h2>
                            <p>The objective of Aurora HR is to enable Nepali citizens to earn a decent living abroad,
                                contribute to the economy, and supply all categories of human resources efficiently. We also
                                aim to:</p>
                            <ul class="list-style-one mt-3">
                                <li>Continue serving Nepali workers by helping them secure better jobs.</li>
                                <li>Enhance the standard of living for Nepali workers.</li>
                                <li>Provide training to aspirant candidates to improve skills for employment abroad.</li>
                                <li>Develop better working relationships between employers and workers.</li>
                                <li>Build long-term business relationships and trust among clients.</li>
                            </ul>
                        </div>

                        <!-- Policy -->
                        <div class="text-box">
                            <h2>Our Policy</h2>
                            <p>We only entertain genuine aspirant workers serious about foreign employment. All procedures
                                follow strict compliance with the Foreign Employment Act and labor department guidelines. We
                                emphasize human and labor rights while ensuring both our foreign clients and job seekers are
                                satisfied throughout the contract period.</p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- service-details end -->
@endsection
