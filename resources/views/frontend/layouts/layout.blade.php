<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.components.head')
    <style>
        .page-title {
            position: relative;
            background: gradient(red, blue);
            background: linear-gradient(to right, #733d0a5e, #3fa7e31c);
            color: white;

            box-shadow: 2px 2px 8px 2px #a3a8ad73;
            align-items: centerr;
        }

        .page-title h1 {
            position: relative;
            display: block;
            font-size: 56px;
            line-height: 60px;
            margin-bottom: 12px;
            color: white;
        }

        .page-title .content-box {
            position: relative;
            display: block;
            padding: 16px;
        }
    </style>
    @stack('styles')
</head>

<body>

    <div class="boxed_wrapper ltr">

        {{-- Preloader --}}

        {{-- Page Direction --}}
        @include('frontend.components.pageDirection')

        {{-- Search Popup --}}
        @include('frontend.components.searchPopup')

        {{-- Main Header --}}
        @include('frontend.components.header')

        {{-- Mobile Menu --}}
        <!-- Mobile Menu  -->
        @include('frontend.components.mobilemenu')
        <!-- End Mobile Menu -->


        {{-- Page Title --}}
        @php
            $currentRoute = Route::currentRouteName();
            $currentUrl = url()->current();
        @endphp

        @if (!isset($breadcrumb) && !in_array($currentRoute, ['home']) && !in_array($currentUrl, [url('/'), url('/home')]))
            @include('frontend.components.breadcrumb')
        @endif


        {{-- Page Content --}}
        @yield('content')

        {{-- Subscribe Style Two --}}
        @if (isset($subscribeStyleTwo))
            @include('frontend.components.subscribeStyleTwo')
        @endif

        {{-- Footer --}}
        @if (!isset($footer))
            @include('frontend.components.footer')
        @endif

        {{-- Scroll to Top --}}
        @include('frontend.components.scroll')

    </div>

    {{-- Scripts --}}
    @include('frontend.components.script')
    @stack('scripts')

</body>

</html>
