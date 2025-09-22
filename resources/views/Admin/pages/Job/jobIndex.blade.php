@extends('Admin.layout.master')
@section('content')
    @include('Admin.pages.Job.jobModal')

    <div class="container-fluid">
        <button class="btn btn-primary addJobBtn mb-4 mt-4">Add Job</button>


        <div class="table-responsive">
            <table class="table table-striped" id="show-job-data">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Salary</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
