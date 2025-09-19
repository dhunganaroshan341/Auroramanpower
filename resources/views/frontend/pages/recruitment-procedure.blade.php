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
    $title = 'Recruitment Process';
    $subTitle = 'Procedures';
@endphp

@section('content')
    <!-- service-details -->
    <section class="service-details pt_110 pb_120">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Sidebar -->
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="service-sidebar mr_40">
                        <div class="category-widget mb_40">
                            <ul class="category-list clearfix">
                                <li><a href="{{ route('required-documents') }}">Required Documents <i class="icon-42"></i></a>
                                </li>
                                <li><a href="{{ route('recruitment-process') }}" class="current">Recruitment Process <i
                                            class="icon-42"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Content Side -->
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="service-details-content">
                        <div class="sec-title mb_70">
                            <span class="sub-title mb_10">Recruitment Process</span>
                            <h2>Comprehensive Procedure for Recruiting Nepali Nationals</h2>
                            <p class="mt_20">Aurora Human Resource Pvt. Ltd. follows a structured recruitment process to
                                ensure that only qualified and suitable candidates are selected for employment abroad. Our
                                process is designed to be transparent, efficient, and compliant with the regulations of the
                                Government of Nepal.</p>
                        </div>

                        <div class="text-box mb_50">
                            <h4>1. Pre-Labor Approval</h4>
                            <p>After receiving the Demand Letter from the employer, the documents are submitted to the
                                Department of Labor in Nepal for approval. The labor department reviews the documents and
                                grants approval for further processing.</p>

                            <h4>2. Advertisement</h4>
                            <p>Once the labor approval is obtained, the demand letter is published in national newspapers to
                                invite applications. Aurora HR Pvt. Ltd. also uses various tools such as the internet, SMS,
                                and telephone to inform potential candidates. Documents are collected either directly from
                                candidates or through sub-agents and marketing executives.</p>

                            <h4>3. Candidate Screening & Interview</h4>
                            <p>All required documents, such as passport copies, photographs, medical reports, and experience
                                certificates, are sent to the employer for initial screening. We maintain a detailed
                                database of potential candidates, including their skills, education, technical expertise,
                                and work experience. Shortlisted candidates are selected based on merit for pre-interview
                                assessments. The final interview is conducted by the employer to make the ultimate
                                selection.</p>

                            <h4>4. Communications</h4>
                            <p>Aurora HR operates with a fully computerized and networked system, ensuring timely and
                                efficient communication with both clients and candidates. Our dedicated staff provides
                                prompt assistance and ensures a smooth recruitment process.</p>

                            <h4>5. Medical Checkup</h4>
                            <p>Selected candidates undergo a full medical examination at government-authorized medical
                                centers in Nepal. Only those who are physically and mentally fit are eligible to sign the
                                employment contract and proceed to visa processing.</p>

                            <h4>6. Visa Processing</h4>
                            <p>All necessary documents, including passport copies, photographs, medical reports, and
                                experience certificates, are forwarded to the employer to complete the visa processing. This
                                step ensures that the candidate meets all requirements for employment abroad.</p>
                        </div>

                        <div class="text-box">
                            <p>Through this structured recruitment process, Aurora HR Pvt. Ltd. ensures the highest
                                standards of professionalism, compliance, and quality in placing Nepali nationals with
                                reputable foreign employers.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- service-details end -->
@endsection
