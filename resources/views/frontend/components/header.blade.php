  <!-- main header -->
  <header class="main-header header-style-two">
      <!-- header-top -->
      <div class="header-top">
          <div class="outer-container">
              <div class="top-inner">
                  <ul class="info">
                      <li>
                          <img src="{{ asset('assets/images/icons/icon-6.png') }}" alt="">
                          Call: <a href="tel:912345432">+91 (234) 5432</a>
                      </li>
                      <li>
                          <img src="{{ asset('assets/images/icons/icon-7.png') }}" alt="">
                          Mail: <a href="mailto:jobinfo@example.com">jobinfo@example.com</a>
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
                  <figure class="logo-box"><a href="{{ route('index') }}"><img
                              src="{{ asset('assets/images/logo-bg.png') }}" alt=""></a></figure>
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
                                  <li style = " color: var(--aurora-red-dark)" class=" homeCurrent "><a
                                          href="{{ route('index') }}">Home</a>
                                      {{-- <ul>
                                                <li><a href="{{ route('index') }}">Home One</a></li>
                                                <li><a href="{{ route('index') }}">Home Two</a></li>
                                                <li><a href="{{ route('index3') }}">Home Three</a></li>
                                                <li><a href="{{ route('index4') }}">Home Four</a></li>
                                                <li><a href="{{ route('index5') }}">Home Five</a></li>
                                            </ul> --}}
                                  </li>
                                  <li><a href="{{ route('about') }}">About</a></li>
                                  {{-- <li class="dropdown"><a href="{{ route('index') }}">Solutions</a>
                                            <ul>
                                                <li><a href="{{ route('service') }}">Our Solutions</a></li>
                                                <li><a href="{{ route('serviceDetails') }}">Executive Search</a></li>
                                                <li><a href="{{ route('serviceDetails2') }}">Training Session</a></li>
                                                <li><a href="{{ route('serviceDetails3') }}">Career Growth</a></li>
                                                <li><a href="{{ route('serviceDetails4') }}">Payroll Services</a></li>
                                                <li><a href="{{ route('serviceDetails5') }}">Workforce System</a></li>
                                                <li><a href="{{ route('serviceDetails6') }}">Temporary Jobs</a></li>
                                            </ul>
                                        </li> --}}
                                  {{-- <li class="dropdown"><a href="{{ route('index') }}">Pages</a>
                                            <ul> --}}
                                  <li class=""><a href="{{ route('index') }}">Category</a>
                                  <li class=""><a href="{{ route('index') }}">Find Jobs</a>

                                  </li>
                                  <li class=""><a href="{{ route('index') }}">Credentials</a>

                                  </li>
                                  {{-- <li class="dropdown"><a href="{{ route('index') }}">Portfolio</a>
                                            <ul>
                                                <li><a href="{{ route('portfolio') }}">Portfolio 3 column</a>
                                                </li>
                                                <li><a href="{{ route('portfolio2') }}">Portfolio 2 column</a>
                                                </li>
                                                <li><a href="{{ route('portfolio3') }}">Portfolio Masonry</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('team') }}">Our Team</a></li>
                                        <li><a href="{{ route('faq') }}">FAQ's</a></li>
                                        <li><a href="{{ route('testimonial') }}">Testimonials</a></li>
                                        <li><a href="{{ route('login') }}">Login</a></li>
                                        <li><a href="{{ route('signup') }}">Sing Up</a></li>
                                        <li><a href="{{ route('pageError') }}">404</a></li>
                                    </ul>
                                    </li> --}}
                                  <li class=""><a href="{{ route('index') }}">Blog</a>
                                      <ul>
                                          <li><a href="{{ route('blog') }}">Blog Grid</a></li>
                                          <li><a href="{{ route('blog2') }}">Blog Standard</a></li>
                                          <li><a href="{{ route('blogDetails') }}">Blog Details</a></li>
                                      </ul>
                                  </li>
                                  <li><a href="{{ route('contact') }}">Contact</a></li>
                              </ul>
                          </div>
                      </nav>
                  </div>
                  <div class="menu-right-content">
                      <div class="search-btn mr_20"><button class="search-toggler"><i class="icon-1"></i></button>
                      </div>
                      <div class="link-box mr_20"><a href="{{ route('login') }}">Log In</a></div>
                      <div class="btn-box"><a href="{{ route('index') }}" class="theme-btn btn-one">Get
                              Started</a></div>
                  </div>
              </div>
          </div>
      </div>

      <!--sticky Header-->
      <div class="sticky-header">
          <div class="outer-container">
              <div class="outer-box">
                  <figure class="logo-box"><a href="{{ route('index') }}"><img
                              src="{{ asset('assets/images/logo-bg.png') }}" alt=""></a></figure>
                  <div class="menu-area">
                      <nav class="main-menu clearfix">
                          <!--Keep Aurora Empty / Menu will come through Javascript-->
                      </nav>
                  </div>
                  <div class="menu-right-content">
                      <div class="search-btn mr_20"><button class="search-toggler"><i class="icon-1"></i></button>
                      </div>
                      <div class="link-box mr_20"><a href="{{ route('login') }}">Log In</a></div>
                      <div class="btn-box"><a href="{{ route('index') }}" class="theme-btn btn-one">Get
                              Started</a></div>
                  </div>
              </div>
          </div>
      </div>
  </header>
  <!-- main-header end -->

  <!-- Mobile Menu  -->
  @include('frontend.components.mobilemenu')
  <!-- End Mobile Menu -->
