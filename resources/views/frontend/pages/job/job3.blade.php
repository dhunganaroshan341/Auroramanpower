@extends('frontend.layouts.layout')

@php
    $title = 'Job Openings';
    $subTitle = 'Job Openings';
    $css =
        '<link href="' .
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
    <!-- job-section -->
    <section class="job-section pt_110 pb_90">
        <div class="auto-container">
            <div class="sec-title centred pb_30 sec-title-animation animation-style2">
                <span class="sub-title mb_10 title-animation">Posted Jobs</span>
                <h2 class="title-animation">Find Your Job</h2>
            </div>

            <!-- Toggle Buttons -->
            <div class="text-center mb-4 d-flex justify-content-center gap-3 flex-wrap">
                <button class="theme-btn toggle-btn active" id="gridViewBtn">
                    <i class="fas fa-th"></i> Latest Jobs
                </button>
                <button class="theme-btn toggle-btn" id="tableViewBtn">
                    <i class="fas fa-list"></i> All Jobs
                </button>
            </div>

            <!-- Grid View -->
            <div id="gridView" class="inner-container">
                <div class="row">
                    @for ($i = 1; $i <= 6; $i++)
                        <div class="col-12 mb-4">
                            <div class="job-block-one h-100">
                                <div class="upper-box">
                                    <ul class="job-info">
                                        <li><i class="icon-43"></i>Posted by <span>{{ rand(1, 12) }} months ago</span>
                                        </li>
                                        <li>Job Code: <span>02225{{ $i }}</span></li>
                                    </ul>
                                </div>
                                <div class="inner-box text-truncate-wrapper">
                                    <div class="title-box">
                                        <div class="icon-box"><i class="icon-44"></i></div>
                                        <h3 class="job-title">Software Engineer {{ $i }}</h3>
                                        <span class="job-location">San Francisco, California</span>
                                    </div>
                                    <div class="salary-box">
                                        <h5>Salary</h5>
                                        <span>$200 - $300 Per Month</span>
                                    </div>
                                    <div class="experience-box">
                                        <h5>Experience needed</h5>
                                        <span>2 - 3 Yrs</span>
                                    </div>
                                    <div class="btn-box">
                                        <a href="{{ route('jobDetails') }}" class="theme-btn btn-one">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Table View -->
            <div id="tableView" class="pt_30 d-none">
                <div class="text-box mb-3">
                    <h2>Job <span>Listings</span></h2>
                </div>
                <div class="table-responsive mb-5">
                    <table id="jobsTable" class="table table-bordered text-center align-middle"
                        style="border-color: var(--secondary-color);">
                        <thead>
                            <tr>
                                <th>Country</th>
                                <th>Company</th>
                                <th>Category</th>
                                <th>Job Title</th>
                                <th>No. of People Requested</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>UAE</td>
                                <td>ABC Manpower</td>
                                <td>Construction</td>
                                <td>Welder</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>Qatar</td>
                                <td>Qatar Co.</td>
                                <td>Hospitality</td>
                                <td>Chef</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>Malaysia</td>
                                <td>XYZ Pvt. Ltd.</td>
                                <td>IT</td>
                                <td>Software Engineer</td>
                                <td>10</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- job-section end -->
@endsection

@push('styles')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* Toggle buttons */
        .toggle-btn {
            border: none;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
        }

        .toggle-btn.active {
            background: var(--theme-color, #ff6600);
            color: #fff;
        }

        /* Job cards */
        .job-title {
            font-size: 16px;
            font-weight: 600;
        }

        .job-location {
            font-size: 13px;
            color: #555;
        }

        .salary-box h5,
        .experience-box h5 {
            font-size: 13px;
        }

        .salary-box span,
        .experience-box span {
            font-size: 13px;
        }

        /* Table styling */
        #jobsTable th {
            font-size: 14px;
        }

        #jobsTable td {
            font-size: 13px;
        }

        #jobsTable thead {
            background: var(--secondary-color);
            color: #fff;
            font-weight: bold;
        }

        #jobsTable tbody tr:hover {
            background: rgba(0, 128, 0, 0.05);
            transition: background 0.3s ease;
        }

        /* DataTable Search box */
        .dataTables_filter input {
            border: 2px solid var(--secondary-color);
            border-radius: 8px;
            padding: 6px 12px;
            outline: none;
            transition: all 0.3s ease;
        }

        .dataTables_filter input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 8px rgba(0, 128, 0, 0.3);
        }

        /* DataTable Length dropdown */
        .dataTables_length select {
            border: 2px solid var(--secondary-color);
            border-radius: 6px;
            padding: 4px 8px;
            background: #fff;
            transition: all 0.3s ease;
        }

        .dataTables_length select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 6px rgba(0, 128, 0, 0.25);
        }

        /* Pagination buttons */
        .dataTables_paginate .paginate_button {
            background: #fff;
            border: 2px solid var(--secondary-color);
            color: var(--secondary-color) !important;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            line-height: 32px;
            margin: 0 4px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .dataTables_paginate .paginate_button:hover {
            background: var(--secondary-color);
            color: #fff !important;
        }

        .dataTables_paginate .paginate_button.current {
            background: var(--secondary-color) !important;
            color: #fff !important;
            border-color: var(--secondary-color);
            font-weight: bold;
            box-shadow: 0 0 6px rgba(0, 128, 0, 0.4);
        }
    </style>
@endpush

@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Toggle between Grid and Table
            const gridBtn = document.getElementById('gridViewBtn');
            const tableBtn = document.getElementById('tableViewBtn');
            const gridView = document.getElementById('gridView');
            const tableView = document.getElementById('tableView');

            gridBtn.addEventListener('click', function() {
                gridView.classList.remove('d-none');
                tableView.classList.add('d-none');
                gridBtn.classList.add('active');
                tableBtn.classList.remove('active');
            });
            tableBtn.addEventListener('click', function() {
                gridView.classList.add('d-none');
                tableView.classList.remove('d-none');
                tableBtn.classList.add('active');
                gridBtn.classList.remove('active');
            });

            // Initialize DataTable
            $('#jobsTable').DataTable({
                language: {
                    paginate: {
                        previous: '<i class="fa fa-chevron-left"></i>',
                        next: '<i class="fa fa-chevron-right"></i>'
                    }
                },
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                ordering: true,
                searching: true
            });
        });
    </script>
@endpush
