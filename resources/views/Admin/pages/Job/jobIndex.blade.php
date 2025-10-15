@extends('Admin.layout.master')

@section('content')
    @include('Admin.pages.Job.jobModal')

    <div class="container-fluid">
        <button class="btn btn-primary addJobBtn mb-4 mt-4">Add Job</button>

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle" id="show-job-data" width="100%">
                <thead class="table-light">
                    <tr>
                        <th>S.N</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Employer</th>
                        {{-- <th>Vacancy</th> --}}
                        <th>Country</th>
                        <th>Categories</th>
                        {{-- <th>Location</th> --}}
                        <th>Salary</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection
