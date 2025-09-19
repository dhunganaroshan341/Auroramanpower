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
    $title = 'Required Documents';
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
                                <li><a href="{{ route('required-documents') }}" class="current">Required Documents <i
                                            class="icon-42"></i></a></li>
                                <li><a href="{{ route('recruitment-process') }}">Recruitment Process <i
                                            class="icon-42"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Content Side -->
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="service-details-content">
                        <div class="sec-title mb_70">
                            <span class="sub-title mb_10">Required Documents</span>
                            <h2>Essential Documents for Recruitment of Nepali Nationals</h2>
                            <p class="mt_20">In accordance with the regulations set by the Ministry of Labor & Transport,
                                Government of Nepal, the following documents are required from foreign employers or their
                                representatives to enable Aurora HR PVT. LTD. to process government formalities for the
                                recruitment of Nepali nationals. All documents should be attested by the Nepalese Consulate,
                                Notary Public, or the Chamber of Commerce of the host country.</p>
                        </div>

                        <div class="text-box mb_50">
                            <h4>For Malaysia:</h4>
                            <ol class="mb_30">
                                <li>KDN Approval (from Labor Ministry)</li>
                                <li>Translation Letter (from Labor Ministry or Home Ministry)</li>
                                <li>Demand Letter</li>
                                <li>Power of Attorney</li>
                                <li>Agency Agreement</li>
                                <li>Employment Contract</li>
                                <li>Notary Public attestation</li>
                                <li>Letter from Nepal Embassy to Labor Department, Nepal</li>
                                <li>ID copy of the authorized person of the employer company</li>
                                <li>Letter from the employer company to Malaysian Consulate in Nepal</li>
                            </ol>

                            <h4>For Japan, Qatar, Kuwait, Bahrain, Oman, and UAE:</h4>
                            <ol>
                                <li>Demand Letter</li>
                                <li>Power of Attorney</li>
                                <li>Agency Agreement</li>
                                <li>Employment Contract</li>
                                <li>Guarantee Letter</li>
                            </ol>
                        </div>

                        <div class="text-box">
                            <p>Ensuring all required documents are properly attested and submitted in accordance with the
                                host country’s regulations helps facilitate a smooth and legally compliant recruitment
                                process.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- service-details end -->
@endsection
