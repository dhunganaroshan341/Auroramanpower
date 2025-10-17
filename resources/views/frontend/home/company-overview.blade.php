@extends('frontend.layouts.layout')

@php
    $subscribeStyleTwo = true;
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

            <!-- First Row: Company Intro -->
            <div class="row align-items-center mb_70">
                <!-- Sidebar -->
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side mb-5 mb-lg-0">
                    <div class="service-sidebar mr_40">
                        <div class="category-widget mb_40">
                            <ul class="category-list clearfix">
                                <li>
                                    <a href="{{ route('company-overview') }}"
                                        class="{{ request()->routeIs('company-overview') ? 'current' : '' }}">
                                        Company Overview <i class="icon-42"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('message-from-chairman') }}"
                                        class="{{ request()->routeIs('message-from-chairman') ? 'current' : '' }}">
                                        Message from Chairman <i class="icon-42"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('license-certificates') }}"
                                        class="{{ request()->routeIs('license-certificates') ? 'current' : '' }}">
                                        License & Certificates <i class="icon-42"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('organizational-chart') }}"
                                        class="{{ request()->routeIs('organizational-chart') ? 'current' : '' }}">
                                        Organizational Chart <i class="icon-42"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Intro Text -->
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="sec-title">
                        <span class="sub-title mb_10">About Aurora HR</span>
                        <h2>Company Overview</h2>
                        <p class="mt_20">
                            Aurora Human Resource (P) Ltd., an international manpower agency, is a pioneer in manpower
                            recruiting.
                            Established with a core belief in providing customer-focused solutions, our team of highly
                            dedicated and experienced professionals is backed with modern resources and a centrally located
                            workplace at Kupondole, Lalitpur.
                            We have successfully deployed over 10,000 unskilled, semi-skilled, and skilled personnel across
                            Asia, Europe, and Gulf countries.
                        </p>
                        <p>
                            Our primary objective is to enable Nepali citizens to earn a decent living abroad while
                            contributing to Nepal’s economy through remittance and addressing unemployment.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Mission & Vision -->
            <div class="row mb-5 g-4">
                <!-- Mission -->
                <div class="col-md-6">
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
                                To provide distinctive services by connecting screened, shortlisted, and deserving
                                candidates with reputed employers, ensuring cost-effective and value-added services that
                                maintain market goodwill and brand reputation.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Vision -->
                <div class="col-md-6">
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
                                To build reliable connections abroad and help address unemployment in Nepal, while deploying
                                potential Nepali manpower to the best international employers worldwide.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Objective & Policy -->
            <div class="row justify-content-center g-4">
                <!-- Objective -->
                <div class="col-lg-6 col-md-6">
                    <div class="card text-center shadow border-0 h-100">
                        <div class="card-body p-5">
                            <h2 class="mb-3">Our Objective <!-- Objective Icon -->
                                <i class="fa fa-bullseye fa-lg"></i></p>
                            </h2>
                            <p>
                                The objective of Aurora HR is to empower Nepali citizens to build prosperous careers abroad
                                while contributing to the national economy. We strive to:
                            </p>
                            <ul class="list-style-one mt-3 text-start d-inline-block">
                                <li>Provide quality employment opportunities to Nepali workers.</li>
                                <li>Enhance the living standards of individuals and families.</li>
                                <li>Offer professional training and guidance for overseas employment.</li>
                                <li>Foster mutual respect and harmony between employers and employees.</li>
                                <li>Establish long-term trust and collaboration with global clients.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Policy -->
                <div class="col-lg-6 col-md-6">
                    <div class="card text-center shadow border-0 h-100">
                        <div class="card-body p-5">
                            <h2 class="mb-3">Our Policy <!-- Policy Icon -->
                                <i class="fa fa-scroll fa-lg"></i>
                            </h2>
                            <p>
                                At Aurora HR, we strictly adhere to Nepal’s Foreign Employment Act and labor regulations.
                                Our policies ensure transparency, fairness, and ethical recruitment practices. We are
                                committed to:
                            </p>
                            <ul class="list-style-one mt-3 text-start d-inline-block">
                                <li>Entertaining only genuine and serious job seekers.</li>
                                <li>Maintaining full compliance with legal requirements.</li>
                                <li>Upholding labor rights and human dignity at every step.</li>
                                <li>Providing clear communication throughout the contract period.</li>
                                <li>Ensuring satisfaction for both clients and workers alike.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
