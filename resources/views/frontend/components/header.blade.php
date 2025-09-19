<!-- main header -->
<header class="main-header header-style-two">
    <!-- header-top -->
    <div class="header-top">
        <div class="outer-container">
            <div class="top-inner">
                <ul class="info">
                    <li>
                        <img src="{{ asset('assets/images/icons/icon-6.png') }}" alt="">
                        Call: <a href="tel:+977015261063">+977-01-5261063 | 5260810</a>
                    </li>
                    <li>
                        <img src="{{ asset('assets/images/icons/icon-7.png') }}" alt="">
                        Mail:
                        <a href="mailto:aurorashrpl@gmail.com">aurorashrpl@gmail.com</a> |
                        <a href="mailto:info@auroranepal.com.np">info@auroranepal.com.np</a>
                    </li>
                </ul>
                <p><span>Latest News:</span> Fusce neque CEO egestas cursu magna sapien</p>
                <div class="right-column">
                    <ul class="social-links">
                        <li><span>Share:</span></li>
                        <li><a href="{{ route('index') }}"><i class="icon-22"></i></a></li>
                        <li><a href="{{ route('index') }}"><i class="icon-23"></i></a></li>
                        <li><a href="{{ route('index') }}"><i class="icon-24"></i></a></li>
                        <li><a href="{{ route('index') }}"><i class="icon-25"></i></a></li>
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
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>
                    <nav class="main-menu navbar-expand-md navbar-light clearfix">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li class="homeCurrent"><a href="{{ route('index') }}">Home</a></li>
                                <li class="dropdown">
                                    <a href="{{ route('about') }}">About</a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('company-overview') }}">Company Overview</a></li>
                                        <li><a href="{{ route('message-from-chairman') }}">Message from Chairman</a>
                                        </li>
                                        <li><a href="{{ route('license-certificates') }}">License & Certificates</a>
                                        </li>
                                        <li><a href="{{ route('orginazational-chart') }}">Organizational Chart</a>
                                        </li>
                                    </ul>
                                </li>

                                <li><a href="{{ route('dynamic-categories') }}">Category</a></li>
                                <li><a href="{{ route('hire') }}">Hire Workers</a></li>
                                <li><a href="{{ route('jobs') }}">Vacancies</a></li>
                                <li class="dropdown">
                                    <a href="{{ route('index') }}">Procedures</a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('required-documents') }}">Required Documents</a></li>
                                        <li><a href="{{ route('recruitment-process') }}">Recruitment Process</a></li>
                                    </ul>
                                </li>

                                <li><a href="{{ route('blog') }}">Blog</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="menu-right-content">

                    <div class="link-box mr_20"><a href="{{ route('jobseeker.create') }}">upload CV</a></div>
                    <div class="btn-box"><a href="{{ route('contact') }}" class="theme-btn btn-one">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--sticky Header-->
    <div class="sticky-header">
        <div class="outer-container">
            <div class="outer-box">
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
                <div class="menu-right-content">
                    <div class="search-btn mr_20">
                        <button class="search-toggler"><i class="icon-1"></i></button>
                    </div>
                    <div class="link-box mr_20"><a href="{{ route('login') }}">Log In</a></div>
                    <div class="btn-box"><a href="{{ route('index') }}" class="theme-btn btn-one">Get Started</a></div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- main-header end -->
