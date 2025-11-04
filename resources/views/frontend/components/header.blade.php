<!-- main header -->
<header class="main-header header-style-two">
    @php
        $currentRoute = Route::currentRouteName();
        $latestNews = getLatestfirstBlog();
    @endphp

    <!-- header-top -->
    <div class="header-top">
        <div class="outer-container">
            <div class="top-inner">
                <ul class="info">
                    <li>
                        <img src="{{ asset('assets/images/icons/icon-6.png') }}" alt="">
                        <a href="tel:+977015261063">+977-01-5261063 | 5260810</a>
                    </li>
                    <li>
                        <img src="{{ asset('assets/images/icons/icon-7.png') }}" alt="">
                      
                        <a href="mailto:aurorashrpl@gmail.com">aurorashrpl@gmail.com</a> |
                        <a href="mailto:info@auroranepal.com.np">info@auroranepal.com.np</a>
                    </li>
                </ul>
                <p>
    <p>
    <span>Latest News:</span>
    @if($latestNews)
        <a href="{{ route('blogDetail', ['slug' => $latestNews->slug]) }}">
            {{ $latestNews->title }}
        </a>
    @else
        <span>No news available</span>
    @endif
</p>

</p>

                <div class="right-column">
                    <ul class="social-links">
                        <li><span>Share:</span></li>
                        <li><a href="{{ route('index') }}"><i class="icon-22"></i></a></li>
                        <li><a href="{{ route('index') }}"><i class="icon-23"></i></a></li>
                        <li><a href="{{ route('index') }}"><i class="icon-24"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- header-lower -->
    <div class="header-lower">
        <div class="outer-container">
            <div class="outer-box">
                <figure class="logo-box">
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('assets/images/logo-bg.png') }}" alt="Aurora Human Resource">
                    </a>
                </figure>

                <div class="menu-area">
                    <!-- Mobile Navigation Toggler -->
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>

                    <nav class="main-menu navbar-expand-md navbar-light clearfix">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li class="{{ $currentRoute === 'index' ? 'current' : '' }}">
                                    <a href="{{ route('index') }}">Home</a>
                                </li>
                                <li class="dropdown {{ in_array($currentRoute, ['about','company-overview','message-from-chairman','license-certificates','organizational-chart']) ? 'current' : '' }}">
                                    <a href="{{ route('about') }}">About</a>
                                    <ul class="submenu">
                                        <li class="{{ $currentRoute === 'company-overview' ? 'current' : '' }}">
                                            <a href="{{ route('company-overview') }}">Company Overview</a>
                                        </li>
                                        <li class="{{ $currentRoute === 'message-from-chairman' ? 'current' : '' }}">
                                            <a href="{{ route('message-from-chairman') }}">Message from Chairman</a>
                                        </li>
                                        <li class="{{ $currentRoute === 'license-certificates' ? 'current' : '' }}">
                                            <a href="{{ route('license-certificates') }}">License & Certificates</a>
                                        </li>
                                        <li class="{{ $currentRoute === 'organizational-chart' ? 'current' : '' }}">
                                            <a href="{{ route('organizational-chart') }}">Organizational Chart</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="{{ $currentRoute === 'dynamic-categories' ? 'current' : '' }}">
                                    <a href="{{ route('dynamic-categories') }}">Category</a>
                                </li>
                                <li class="{{ $currentRoute === 'hire' ? 'current' : '' }}">
                                    <a href="{{ route('hire') }}">Hire Workers</a>
                                </li>
                                <li class="{{ $currentRoute === 'jobs' ? 'current' : '' }}">
                                    <a href="{{ route('jobs') }}">Vacancies</a>
                                </li>
                                <li class="dropdown {{ in_array($currentRoute, ['required-documents','recruitment-process']) ? 'current' : '' }}">
                                    <a href="#">Procedures</a>
                                    <ul class="submenu">
                                        <li class="{{ $currentRoute === 'required-documents' ? 'current' : '' }}">
                                            <a href="{{ route('required-documents') }}">Required Documents</a>
                                        </li>
                                        <li class="{{ $currentRoute === 'recruitment-process' ? 'current' : '' }}">
                                            <a href="{{ route('recruitment-process') }}">Recruitment Process</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="{{ $currentRoute === 'blog' ? 'current' : '' }}">
                                    <a href="{{ route('blog') }}">Blog</a>
                                </li> <li class="{{ $currentRoute === 'contact' ? 'current' : '' }}">
                                    <a href="{{ route('contact') }}">contact us</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>

                <!-- Right menu / user links -->
               <!-- Right menu / user links -->
<div class="menu-right-content d-flex align-items-center">

    @auth
        {{-- Logged-in user --}}
        <div class="dropdown me-3"> <!-- added me-3 for gap -->
            <a href="#" class="d-flex align-items-center" id="userMenuDropdown"
               data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('user.png') }}" alt="User Avatar" class="rounded-circle" width="35"
                     height="35">
                <i class="fas fa-chevron-down ms-2"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuDropdown">
                <li class="dropdown-header">Hello, {{ auth()->user()->full_name }}</li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                <li><a class="dropdown-item" href="{{ route('jobseeker.create') }}">Upload CV</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logoutPostRequest') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
   @else
    {{-- Guest --}}
    <div class="link-box me-3">
        <a href="{{ route('login') }}" >Login</a>
    </div>
    {{-- <div class="link-box">
        <a href="{{ route('jobseeker.create') }}" class="theme-btn btn-one">Upload CV</a>
    </div> --}}
@endauth


    <div class="btn-box">
        <a href="{{ route('jobseeker.create') }}" class="theme-btn btn-one">Upload Cv</a>
    </div>

</div>

            </div>
        </div>
    </div>

    <!-- sticky Header (same user menu for mobile) -->
    <div class="sticky-header">
        <div class="outer-container">
            <div class="outer-box d-flex justify-content-between align-items-center">
                <figure class="logo-box">
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('assets/images/logo-bg.png') }}" alt="Aurora Human Resource">
                    </a>
                </figure>

                <div class="menu-area">
                    <nav class="main-menu clearfix">
                        <!-- Aurora Menu loaded via JS -->
                    </nav>
                </div>

                <div class="menu-right-content d-flex align-items-center">
                   

                    @auth
                        <div class="dropdown me-3">
                            <a href="#" class="d-flex align-items-center" id="userMenuDropdownSticky"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('user.png') }}" alt="User Avatar" class="rounded-circle" width="35"
                                     height="35">
                                <i class="fas fa-chevron-down ms-2"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuDropdownSticky">
                                <li class="dropdown-header">Hello, {{ auth()->user()->full_name }}</li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('jobseeker.create') }}">Upload CV</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logoutPostRequest') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="link-box me-3"><a href="{{ route('jobseeker.create') }}">Upload CV</a></div>
                    @endauth

                    <div class="btn-box"><a href="{{ route('contact') }}" class="theme-btn btn-one">Contact us</a></div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- main-header end -->
