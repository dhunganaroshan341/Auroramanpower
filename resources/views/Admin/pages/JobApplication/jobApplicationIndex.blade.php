@extends('Admin.layout.master')


@section('content')
    @include('Admin.pages.Job.jobModal')

    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 mt-4">
            <a href="{{ route('admin.job-applications.index') }}" class="btn btn-primary mb-2">Reset</a>

            <div class="d-flex flex-wrap gap-3">
                <!-- Job filter dropdown -->
                <select id="jobFilter" class="form-select w-auto">
                    <option value="">-- Select Job --</option>
                    @foreach(\App\Models\Job::all() as $job)
                        <option value="{{ $job->id }}">{{ $job->title }}</option>
                    @endforeach
                </select>

                <!-- Status filter dropdown -->
                <select id="statusFilter" class="form-select w-auto">
                    <option value="">-- Select Status --</option>
                    <option value="Pending">Pending</option>
                    <option value="Accepted">Accepted</option>
                    <option value="Rejected">Rejected</option>
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table id="show-application-data" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Job Title</th>
                        <th>Job Seeker</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    @include('Admin.pages.JobApplication.applicantInfoModal')
@endsection 