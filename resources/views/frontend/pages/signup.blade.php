@extends('frontend.layouts.layout')

@php
    $css = '<link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/login.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
    $title = 'Sign Up';
    $subTitle = 'Sign Up';
@endphp

@section('content')
<section class="sign-section pt_110 pb_120">
    <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-25.png') }}')"></div>
    <div class="auto-container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="form-inner shadow p-5 rounded">
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="mb-3" width="120">
                        <h3 class="mb-2">Create Account</h3>
                        <p class="text-muted">Sign up to get started with your account</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        @if(session()->has('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="form-group mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-grid mb-3">
                           
                            <button type="submit" class="theme-btn btn-one ">Sign Up</button>
                        
                        </div>

                        <div class="text-center mb-3">or continue with</div>

                        <div class="d-flex justify-content-center gap-3 mb-3">
                            <a href="{{ route('signup') }}" class="btn btn-light border w-50">
                                <img src="{{ asset('assets/images/icons/icon-25.png') }}" alt="" class="me-2"> Google
                            </a>
                            <a href="{{ route('signup') }}" class="btn btn-light border w-50">
                                <img src="{{ asset('assets/images/icons/icon-26.png') }}" alt="" class="me-2"> Facebook
                            </a>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>

                        <div class="text-center">
                            Already have an account? <a href="{{ route('login') }}" class="text-primary">Login Here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
