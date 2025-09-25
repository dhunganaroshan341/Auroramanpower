@extends('frontend.layouts.layout')

@php
    $title = 'Vacancy Details';
    $subTitle = 'Vacancy Details';
    $css =
        '<link href="' .
        asset('assets/css/module-css/header.css') .
        '" rel="stylesheet">
        <link href="' .
        asset('assets/css/module-css/page-title.css') .
        '" rel="stylesheet">
        <link href="' .
        asset('assets/css/module-css/job-details.css') .
        '" rel="stylesheet">
        <link href="' .
        asset('assets/css/module-css/subscribe.css') .
        '" rel="stylesheet">
        <link href="' .
        asset('assets/css/module-css/footer.css') .
        '" rel="stylesheet">';
@endphp

@section('content')
    @include('frontend.pages.job.jobApplyModal')
    <section class="job-details pt_110 pb_120">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Sidebar -->
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="job-sidebar mr_40">
                        <div class="info-widget sidebar-widget mb_30">
                            <h3 class="mb_20">Vacancy Info</h3>
                            <ul class="clearfix">
                                <li>
                                    <h5>Country</h5>
                                    <p>Japan</p>
                                </li>
                                <li>
                                    <h5>Company</h5>
                                    <p>ABC Manpower Pvt. Ltd.</p>
                                </li>
                                <li>
                                    <h5>Apply Before</h5>
                                    <p>25th March, 2025</p>
                                </li>
                                <li>
                                    <h5>Vacancy Code</h5>
                                    <p>VC1023</p>
                                </li>
                            </ul>
                        </div>

                        <div class="requirements-widget sidebar-widget">
                            <h3>General Requirements</h3>
                            <ul class="clearfix">
                                <li><span>Age:</span> 21 – 40 years</li>
                                <li><span>Sex:</span> Male / Female</li>
                                <li><span>Education:</span> High School / Diploma or above</li>
                                <li><span>Experience:</span> Relevant field experience preferred</li>
                                <li><span>Skills:</span> Teamwork, discipline, adaptability</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Content Side -->
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="job-details-content">

                        <!-- Toggle Buttons -->
                        <div class="mb-4 d-flex gap-3 align-items-start">
                            <button class="theme-btn toggle-btn active" id="imageViewBtn">Newspaper Advertisment</button>
                            <button class="theme-btn toggle-btn" id="descriptionViewBtn"> More Detail</button>

                            <!-- Trigger Button -->
                            <div>
                                <button type="button" class="btn theme-btn toggle-btn" data-bs-toggle="modal"
                                    data-bs-target="#applyJobModal">
                                    <i class="fas fa-file-alt"></i>


                                    Apply
                                </button>
                                <a href = "{{ route('jobseeker.create') }}" class="btn theme-btn toggle-btn">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                    Login with CV
                                </a>



                            </div>
                        </div>


                        <!-- Image View -->
                        <div id="imageView">
                            <div class="text-box mb_60">
                                <img src="{{ asset('assets/images/AURORA-HUMAN-RESOURCE-PVT.-LTD.-24-Poush-2080-copy_page-0001.jpg') }}"
                                    alt="Vacancy Image" class="img-fluid rounded shadow-sm">
                                <p class="mt_20 text-muted">Scan of the original job posting.</p>
                            </div>
                        </div>

                        <!-- Description View -->
                        <div id="descriptionView" class="d-none">
                            <div class="text-box mb_60">
                                <h3>Jobs List</h3>
                                <ul class="list-item">
                                    <li><strong>Factory Worker</strong> – 25 openings (Salary: $800 – $1000/month)</li>
                                    <li><strong>Driver</strong> – 15 openings (Salary: $900 – $1200/month)</li>
                                    <li><strong>Welder</strong> – 10 openings (Salary: $1000 – $1500/month)</li>
                                </ul>
                            </div>
                            <div class="text-box mb_60">
                                <h3>Job Description</h3>
                                <p>This vacancy provides an opportunity for candidates to work in Japan under ABC Manpower’s
                                    recruitment program. The positions available are across industrial and technical sectors
                                    with competitive salaries, accommodation support, and medical facilities as per company
                                    policies.</p>
                            </div>
                            <div class="text-box mb_60">
                                <h3>Responsibilities</h3>
                                <ul class="list-item">
                                    <li>Perform duties as per assigned job role efficiently and responsibly.</li>
                                    <li>Adhere to company and safety guidelines in the workplace.</li>
                                    <li>Maintain professionalism and teamwork within the assigned department.</li>
                                    <li>Willingness to learn and adapt to Japanese work culture.</li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .toggle-btn {
            padding: 8px 16px;
            border: none;
            cursor: pointer;
        }

        .toggle-btn.active {
            background: var(--theme-color, #ff6600);
            color: #fff;
        }

        .newspaper-image img {
            border: 1px solid #ddd;
            max-width: 100%;
            height: auto;
            object-fit: contain;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageBtn = document.getElementById('imageViewBtn');
            const descBtn = document.getElementById('descriptionViewBtn');
            const imageView = document.getElementById('imageView');
            const descriptionView = document.getElementById('descriptionView');

            imageBtn.addEventListener('click', () => {
                imageView.classList.remove('d-none');
                descriptionView.classList.add('d-none');
                imageBtn.classList.add('active');
                descBtn.classList.remove('active');
            });

            descBtn.addEventListener('click', () => {
                descriptionView.classList.remove('d-none');
                imageView.classList.add('d-none');
                descBtn.classList.add('active');
                imageBtn.classList.remove('active');
            });
        });
    </script>
@endpush
