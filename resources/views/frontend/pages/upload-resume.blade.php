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
            <div class="form-inner">
                <form method="post" action="{{ route('jobseeker.store') }}" enctype="multipart/form-data">
                    @csrf

                    @guest
                        <!-- Show only if user is not logged in -->
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" required>
                        </div>
                    @endguest

                    <!-- Profile Details -->
                    <div class="form-group">
                        <label>Bio</label>
                        <textarea name="bio" required>{{ old('bio') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Skills</label>
                        <textarea name="skills" required>{{ old('skills') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Experience</label>
                        <textarea name="experience" required>{{ old('experience') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Education</label>
                        <textarea name="education" required>{{ old('education') }}</textarea>
                    </div>

                    <!-- File Upload -->
                    <div class="form-group">
                        <label>Upload Resume (PDF, DOC, DOCX)</label>
                        <input type="file" name="resume_file" accept=".pdf,.doc,.docx" required>
                    </div>

                    <div class="form-group message-btn">
                        <button type="submit" class="theme-btn btn-one">Submit CV</button>
                    </div>
                </form>

                @guest
                    <div class="lower-text centred">
                        <p>Already registered? <a href="{{ route('login') }}">Login Here</a></p>
                    </div>
                @endguest
            </div>
        </div>
    </section>
@endsection
