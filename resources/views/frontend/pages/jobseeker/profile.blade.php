@extends('frontend.layouts.layout')

@php
    $title = 'My Profile';
    $subTitle = 'Update Your Details';
    $css =
        '<link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
         <link href="' . asset('assets/css/module-css/job.css') . '" rel="stylesheet">
         <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
         <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">
         <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">';
@endphp

@section('content')
<section class="job-form-section dark-section pt_110 pb_90">
    <div class="auto-container">

        <!-- Section Title -->
        <div class="sec-title centred pb_50 sec-title-animation animation-style2">
            <span class="sub-title mb_10 title-animation">YOUR PROFILE</span>
            <h2 class="title-animation">Edit Your Profile & View Applied Jobs</h2>
            <p class="title-animation">Update your information or CV, and see all jobs you've applied to.</p>
        </div>

        <!-- Profile Update Form -->
        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-4">

                <!-- Basic Information -->
                <div class="col-lg-6 col-md-12 col-sm-12 form-column">
                    <div class="form-inner">
                        <h3>Basic Information</h3>
                        <div class="row g-3">
                            <div class="col-lg-6 form-group">
                                <input type="text" name="name" placeholder="Full Name" value="{{ old('name', $user->full_name) }}" class="form-control" required>
                            </div>
                            <div class="col-lg-6 form-group">
                                <input type="email" name="email" placeholder="Email" value="{{ old('email', $user->email) }}" class="form-control" required>
                            </div>
                            <div class="col-lg-6 form-group">
                                <input type="text" name="phone" placeholder="Phone" value="{{ old('phone', $user->phone) }}" class="form-control" required>
                            </div>
                            <div class="col-lg-6 form-group">
                                <input type="text" name="address" placeholder="Address" value="{{ old('address', $user->address ?? '') }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Education & Skills -->
                <div class="col-lg-6 col-md-12 col-sm-12 form-column">
                    <div class="form-inner">
                        <h3>Education & Skills</h3>
                        <div class="row g-3">
                            <div class="col-lg-12 form-group">
                                <input type="text" name="education" placeholder="Education" value="{{ old('education', $profile->education ?? '') }}" class="form-control" required>
                            </div>
                            <div class="col-lg-6 form-group">
                                <input type="text" name="skills" placeholder="Skills" value="{{ old('skills', $profile->skills ?? '') }}" class="form-control" required>
                            </div>
                            <div class="col-lg-6 form-group">
                                <input type="text" name="experience" placeholder="Experience" value="{{ old('experience', $profile->experience ?? '') }}" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upload CV -->
                <!-- Upload CV -->
<div class="col-lg-12 col-md-12 col-sm-12 form-group">
    <label for="resume_file" class="form-label fw-bold">Upload Your CV</label>
    <div class="d-flex align-items-center gap-3">
        <div class="upload-box d-flex align-items-center border rounded p-3 bg-theme-secondary text-white flex-grow-1">
            <i class="fas fa-upload fa-2x me-3"></i>
            <input type="file" id="resume_file" name="resume_file" accept=".pdf,.doc,.docx" class="form-control-file flex-grow-1">
            <span class="btn btn-light ms-3">Browse</span>
        </div>

        @if($profile && $profile->resume_file)
            @php
                $fileExt = pathinfo($profile->resume_file, PATHINFO_EXTENSION);
                $iconClass = $fileExt === 'pdf' ? 'fas fa-file-pdf text-danger' : 'fas fa-file-word text-primary';
            @endphp
            <a href="{{ asset('uploads/' . $profile->resume_file) }}" target="_blank" class="d-flex align-items-center text-white">
                <i class="{{ $iconClass }} fa-2x me-2"></i>
                <span>View / Download CV</span>
            </a>
        @endif
    </div>
    <small class="form-text text-light">Accepted formats: PDF, Word (.doc, .docx)</small>
</div>


                <!-- Additional Info -->
                <div class="col-lg-12 col-md-12 col-sm-12 form-column">
                    <textarea name="bio" placeholder="Additional Information.." rows="4" class="form-control">{{ old('bio', $profile->bio ?? '') }}</textarea>
                    <div class="form-group message-btn centred mt-3">
                        <button type="submit" class="theme-btn btn-one w-100">Update Profile</button>
                    </div>
                </div>

            </div>
        </form>

        <!-- Applied Jobs Table -->
        <div class="pt_50">
            <h3 class="text-white mb-4">Jobs You've Applied To</h3>
            <table id="appliedJobsTable" class="display table table-striped table-dark" style="width:100%">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Company</th>
                        <th>Applied On</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appliedJobs as $application)
                    <tr>
                        <td>{{ $application->job->title ?? 'N/A' }}</td>
                        <td>{{ $application->job->company_name ?? 'N/A' }}</td>
                        <td>{{ $application->created_at->format('d M Y') }}</td>
                        <td>{{ $application->status }}</td>
                        <td>
                            <a href="{{ route('jobById', ['id' => $application->job->id]) }}" class="btn btn-sm btn-primary">View Job</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</section>

@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        $('#appliedJobsTable').DataTable({
            paging: true,
            searching: true,
            info: false,
            responsive: true
        });
    });
</script>
@endpush
