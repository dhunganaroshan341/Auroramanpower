@extends('frontend.layouts.layout')

@php
    $title = 'Vacancy Details';
    $subTitle = 'Vacancy Details';
    $css =
        '
        <link href="' . asset('assets/css/module-css/header.css') . '" rel="stylesheet">
        <link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
        <link href="' . asset('assets/css/module-css/job-details.css') . '" rel="stylesheet">
        <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
        <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">
    ';
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
                                <li><h5>Salary</h5><p>{{ $job->salary ?? 'N/A' }}</p></li>
                                <li><h5>Country</h5><p>{{ $job->ourCountry->name ?? 'N/A' }}</p></li>
                                <li><h5>Category</h5>
                                    <p>
                                        @foreach ($job->categories as $category)
                                            {{ $category->name }}@if (!$loop->last), @endif
                                        @endforeach
                                    </p>
                                </li>
                                <li><h5>Interview Date</h5><p>{{ \Carbon\Carbon::parse($job->interview_date)->format('d M, Y') ?? 'N/A' }}</p></li>
                                <li><h5>Vacancy Code</h5><p>{{ $job->job_code ?? 'N/A' }}</p></li>
                            </ul>
                        </div>

                        <div class="requirements-widget sidebar-widget">
                            <h3>General Requirements</h3>
                            <div class="requirements-content">
                                {!! $job->requirements ?? '<p>No requirements specified.</p>' !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Side -->
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="job-details-content">

                        <!-- Toggle Buttons + Apply -->
                        <div class="mb-4 d-flex gap-3 align-items-start">
                            <button class="theme-btn toggle-btn active" id="descriptionViewBtn"> Detail</button>
                           
                            <button class="theme-btn toggle-btn " id="imageViewBtn">Newspaper Advertisement</button>

                            <div>
                                

                                <!-- Login & Auto Apply (for guests) -->
                                @guest
                                <!-- Regular Apply Button (opens modal) -->
                                <button type="button" class="btn theme-btn toggle-btn" data-bs-toggle="modal"
                                    data-bs-target="#applyJobModal">
                                    <i class="fas fa-file-alt"></i> Apply
                                </button>
                                    <a href="{{ route('jobseeker.create') }}" class="btn theme-btn toggle-btn">
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i> Signup & Auto Apply
                                    </a>
                                @endguest

                                <!-- Smart Apply (for logged-in users) -->
                                @auth
    @if(auth()->user()->jobSeekerProfile)
        @php
            $alreadyApplied = auth()->user()->jobSeekerProfile->hasAppliedTo($job->id);

        @endphp

        @if($alreadyApplied)
            <button type="button" class="btn theme-btn toggle-btn" disabled>
                <i class="fa fa-check" aria-hidden="true"></i> Already Applied
            </button>
        @else
            <form id = "smartApplyForm"action="{{ route('jobseeker.smartApply', ['id' => $job->id]) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn theme-btn toggle-btn">
                    <i class="fa fa-paper-plane" aria-hidden="true"></i> Apply as {{ auth()->user()->full_name }}
                </button>
            </form>
        @endif
    @endif
@endauth

                            </div>
                        </div>

                        <!-- Image View -->
                        <div id="imageView">
                            @if ($job->image)
                                <div class="text-box mb_60">
                                    <img src="{{ asset($job->image) }}" alt="Vacancy Image" class="img-fluid rounded shadow-sm">
                                    <p class="mt_20 text-muted">Scan of the original job posting.</p>
                                </div>
                            @else
                                <p class="text-muted">No advertisement image available.</p>
                            @endif
                        </div>

                        <!-- Description View -->
                        <div id="descriptionView" class="d-none">
                            <div class="text-box mb_60">
                                <h3>{{ $job->title }}</h3>
                                <p>{!! $job->description ?? 'No description available.' !!}</p>
                            </div>

                            @if ($job->responsibilities)
                                <div class="text-box mb_60">
                                    <h3>Responsibilities</h3>
                                    {!! $job->responsibilities !!}
                                </div>
                            @endif
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
        .requirements-content ul {
            padding-left: 20px;
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


            const form = document.getElementById('smartApplyForm');

    if(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // prevent default form submit

            const url = form.action;
            const formData = new FormData(form);

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Applied Successfully!',
                        text: data.message,
                        confirmButtonText: 'OK'
                    });
                    // Optionally, disable the button after success
                    form.querySelector('button').disabled = true;
                    form.querySelector('button').innerHTML = '<i class="fa fa-check"></i> Already Applied';
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops!',
                        text: data.message,
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong. Please try again.',
                    confirmButtonText: 'OK'
                });
                console.error(error);
            });
        });
    }
        });
    </script>
@endpush
