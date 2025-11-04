@extends('Admin.layout.master')

@section('content')
    {{-- Optional Modal for Adding/Editing Job Seeker Profiles --}}
    @includeIf('Admin.pages.JobSeekerProfiles.modal')

    <div class="container-fluid">
        <button class="btn btn-primary addJobSeekerBtn mb-4 mt-4">Add Job Seeker Profile</button>

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle" id="show-jobseeker-data" width="100%">
                <thead class="table-light">
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Skills</th>
                        <th>Experience</th>
                        <th>Education</th>
                        <th>Resume</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection

