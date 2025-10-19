@extends('frontend.layouts.layout')

@php
    $css = '<link href="' . asset('assets/css/module-css/page-title.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/login.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/subscribe.css') . '" rel="stylesheet">
            <link href="' . asset('assets/css/module-css/footer.css') . '" rel="stylesheet">';
    $title = 'Login';
    $subTitle = 'Login';
@endphp

@section('content')
<section class="sign-section pt_110 pb_120">
    <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-25.png') }}')"></div>
    <div class="auto-container">
        <div class="form-inner">

            {{-- Logo --}}
            <div class="text-center mb_30">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Aurora Logo" width="120">
                <h4 class="mt_20">{{ $title ?? 'Aurora' }}</h4>
            </div>

            {{-- Success Message --}}
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Error Message --}}
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Login Form --}}
            <form method="POST" action="{{ route('login.store') }}" class="login-form">
                @csrf
                <div class="form-group">
                    <label>Email <span>*</span></label>
                    <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required
                        class="@error('email') is-invalid @enderror">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password <span>*</span></label>
                    <input type="password" name="password" placeholder="Enter your password" required
                        class="@error('password') is-invalid @enderror">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="other-option">
                    <div class="check-box">
                        <input class="check" type="checkbox" id="checkbox1" name="remember">
                        <label for="checkbox1">Remember me</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="forgot-password">Forgot password?</a>
                </div>

                <div class="form-group message-btn">
                    <button type="submit" class="theme-btn btn-one w-100">Sign In</button>
                </div>

                <span class="text">or</span>

                <ul class="social-links clearfix">
                    <li>
                        <a href="#"><img src="{{ asset('assets/images/icons/icon-25.png') }}" alt=""> Continue with Google</a>
                    </li>
                    <li>
                        <a href="#"><img src="{{ asset('assets/images/icons/icon-26.png') }}" alt=""> Continue with Facebook</a>
                    </li>
                </ul>
            </form>

            <div class="lower-text centred">
                <p>Don't have an account? <a href="{{ route('register') }}">Create one</a></p>
            </div>

        </div>
    </div>
</section>
@endsection
