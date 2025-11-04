@extends('Admin.layout.master')

@section('content')
    @include('Admin.pages.Job.jobModal')

    <div class="container-fluid">
        <button class="btn btn-primary addJobBtn mb-4 mt-4">Add Job</button>

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
@endsection
