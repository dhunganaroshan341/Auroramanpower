<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.components.head')
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
        @if (!isset($breadcrumb))
            @include('frontend.components.breadcrumb')
        @endif

        {{-- Page Content --}}
        @yield('content')

        {{-- Subscribe Style Two --}}
        @if (!isset($subscribeStyleTwo))
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

</body>

</html>
