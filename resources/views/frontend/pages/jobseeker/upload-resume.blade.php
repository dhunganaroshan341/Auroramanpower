@extends('frontend.layouts.layout')

@php
    $css =
        '
        <link href="' .
        asset('assets/css/module-css/page-title.css') .
        '" rel="stylesheet">
        <link href="' .
        asset('assets/css/module-css/login.css') .
        '" rel="stylesheet">
        <link href="' .
        asset('assets/css/module-css/subscribe.css') .
        '" rel="stylesheet">
        <link href="' .
        asset('assets/css/module-css/footer.css') .
        '" rel="stylesheet">
    ';
    $title = 'Upload CV';
    $subTitle = 'Submit Your Profile';
@endphp

@section('content')
    <section class="sign-section pt_110 pb_120">
        <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-25.png') }}')"></div>
        <div class="auto-container">
            <div class="form-inner shadow-lg p-4 rounded bg-white">
                <h3 class="mb-4 text-center">Submit Your Profile</h3>

                <form method="post" action="{{ route('jobseeker.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        @guest
                            <!-- Guest info -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>
                            </div>
                        @endguest
                    </div>

                    <!-- Profile Details -->
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Bio</label>
                            <textarea class="form-control" name="bio" rows="3" required>{{ old('bio') }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Skills</label>
                            <textarea class="form-control" name="skills" rows="3" required>{{ old('skills') }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Experience</label>
                            <textarea class="form-control" name="experience" rows="3" required>{{ old('experience') }}</textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Education</label>
                            <textarea class="form-control" name="education" rows="3" required>{{ old('education') }}</textarea>
                        </div>
                    </div>

                    <!-- File Upload -->
                    <div class="mb-3">
                        <label class="form-label">Upload Resume (PDF, DOC, DOCX)</label>
                        <input type="file" class="form-control" name="resume_file" accept=".pdf,.doc,.docx" required>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="theme-btn btn-one px-5">Submit CV</button>
                    </div>
                </form>

                @guest
                    <div class="lower-text centred mt-3">
                        <p>Already registered? <a href="{{ route('login') }}">Login Here</a></p>
                    </div>
                @endguest
            </div>
        </div>
    </section>
@endsection
