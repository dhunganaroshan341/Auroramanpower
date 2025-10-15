@extends('frontend.layouts.layout')

@php
    $title = 'Job Openings';
    $subTitle = 'Job Openings';
    $css =
        '
        <link href="' .
        asset('assets/css/module-css/header.css') .
        '" rel="stylesheet">
        <link href="' .
        asset('assets/css/module-css/page-title.css') .
        '" rel="stylesheet">
        <link href="' .
        asset('assets/css/module-css/job.css') .
        '" rel="stylesheet">
        <link href="' .
        asset('assets/css/module-css/welcome.css') .
        '" rel="stylesheet">
        <link href="' .
        asset('assets/css/module-css/subscribe.css') .
        '" rel="stylesheet">
        <link href="' .
        asset('assets/css/module-css/footer.css') .
        '" rel="stylesheet">';
@endphp

@section('content')
    <section class="job-section pt_110 pb_90">
        <div class="auto-container">
            <div class="sec-title centred pb_30 sec-title-animation animation-style2">
                <span class="sub-title mb_10 title-animation">Posted Jobs</span>
                <h2 class="title-animation">Find Your Job</h2>
            </div>

            <!-- Toggle Buttons -->
            <div class="text-center mb-4 d-flex justify-content-center gap-3 flex-wrap">
                <button class="theme-btn toggle-btn active" id="latestJobsBtn">
                    <i class="fas fa-th"></i> Latest Jobs
                </button>
                <button class="theme-btn toggle-btn" id="topCategoriesBtn">
                    <i class="fas fa-list"></i> Top Categories
                </button>
            </div>

            <!-- Latest Jobs Grid -->
            <div id="latestJobsView" class="inner-container">
                <div class="row">
                    @foreach ($latestJobs as $job)
                        <div class="col-12 mb-4">
                            <div class="job-block-one h-100">
                                <div class="upper-box">
                                    <ul class="job-info">
                                        <li><i class="icon-43"></i>Posted
                                            <span>{{ $job->created_at->diffInDays(now()) }} days ago</span>
                                        </li>
                                        <li>Vacancy Code: <span>{{ $job->job_code ?? 'VC' . $job->id }}</span></li>
                                    </ul>
                                </div>

                                <div class="inner-box">
                                    <div class="title-box">
                                        <h3 class="job-title">{{ $job->title }}</h3>
                                        <span
                                            class="job-subheading">{{ $job->vacancy?->custom_company_name ?? ($job->vacancy?->company->name ?? 'N/A') }}</span>
                                    </div>

                                    <div class="jobs-list-box">
                                        <ul>
                                            <li>
                                                <strong>Openings:</strong>
                                                {{ $job->total_openings ?? ($job->male_opening + $job->female_opening ?? 'N/A') }}
                                            </li>
                                            @if ($job->categories)
                                                <li>
                                                    <strong>Category:</strong>
                                                    {{ implode(', ', $job->categories->pluck('name')->toArray()) }}
                                                </li>
                                            @endif
                                            @if ($job->location)
                                                <li>
                                                    <strong>Location:</strong> {{ $job->location }}
                                                </li>
                                            @endif
                                        </ul>
                                    </div>

                                    <div class="btn-box mt-3">
                                        <a href="{{ route('jobDetails', $job->id) }}" class="theme-btn btn-one">View
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Top Categories View -->
            <div id="topCategoriesView" class="inner-container d-none">
                @foreach ($categoryJobs as $cat)
                    <h4 class="mb-3 mt-4">{{ $cat['category_name'] }} ({{ count($cat['jobs']) }} jobs)</h4>
                    <div class="row mb-4">
                        @foreach ($cat['jobs'] as $job)
                            <div class="col-12 mb-3">
                                <div class="job-block-one h-100">
                                    <div class="upper-box">
                                        <ul class="job-info">
                                            <li><i class="icon-43"></i>Posted
                                                <span>{{ $job->created_at->diffInDays(now()) }} days ago</span>
                                            </li>
                                            <li>Vacancy Code: <span>{{ $job->job_code ?? 'VC' . $job->id }}</span></li>
                                        </ul>
                                    </div>

                                    <div class="inner-box">
                                        <div class="title-box">
                                            <h3 class="job-title">{{ $job->title }}</h3>
                                            <span
                                                class="job-subheading">{{ $job->vacancy?->custom_company_name ?? ($job->vacancy?->company->name ?? 'N/A') }}</span>
                                        </div>

                                        <div class="jobs-list-box">
                                            <ul>
                                                <li><strong>Openings:</strong>
                                                    {{ $job->total_openings ?? ($job->male_opening + $job->female_opening ?? 'N/A') }}
                                                </li>
                                                @if ($job->location)
                                                    <li><strong>Location:</strong> {{ $job->location }}</li>
                                                @endif
                                            </ul>
                                        </div>

                                        <div class="btn-box mt-3">
                                            <a href="{{ route('jobDetails', $job->id) }}" class="theme-btn btn-one">View
                                                Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const latestBtn = document.getElementById('latestJobsBtn');
            const topBtn = document.getElementById('topCategoriesBtn');
            const latestView = document.getElementById('latestJobsView');
            const topView = document.getElementById('topCategoriesView');

            latestBtn.addEventListener('click', function() {
                latestView.classList.remove('d-none');
                topView.classList.add('d-none');
                latestBtn.classList.add('active');
                topBtn.classList.remove('active');
            });

            topBtn.addEventListener('click', function() {
                latestView.classList.add('d-none');
                topView.classList.remove('d-none');
                topBtn.classList.add('active');
                latestBtn.classList.remove('active');
            });
        });
    </script>
@endpush
