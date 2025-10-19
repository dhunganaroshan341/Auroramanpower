 
 @if (!empty($why_us_content))
    {{-- ✅ Dynamic content from DB --}}
    <section class="chooseus-section alternat-2 pt_120 pb_90">
        {!! $why_us_content->content !!}
    </section>
@else
 <section class="chooseus-section alternat-2 pt_120 pb_90">

        <div class="auto-container">
            <div class="sec-title pb_60 sec-title-animation animation-style2">
                <span class="sub-title mb_10 title-animation">Why Us</span>
                <h2 class="title-animation">Why Choose Us</h2>
            </div>
            <div class="inner-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                        <div class="chooseus-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-4"></i></div>
                                <h3><a href="{{ route('index') }}">Retain Top Talent</a></h3>
                                <p>Providing clear career paths and growth opportunities is key to retaining top
                                    talent.</p>
                                <div class="link"><a href="{{ route('index') }}">Learn More<i class="icon-7"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                        <div class="chooseus-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-5"></i></div>
                                <h3><a href="{{ route('index') }}">Stay Compliant</a></h3>
                                <p>Educate employees about compliance requirements through regular training</p>
                                <div class="link"><a href="{{ route('index') }}">Learn More<i class="icon-7"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 chooseus-block">
                        <div class="chooseus-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-6"></i></div>
                                <h3><a href="{{ route('index') }}">Improve Employee</a></h3>
                                <p>Invest in employee training and development programs to enhance skills </p>
                                <div class="link"><a href="{{ route('index') }}">Learn More<i class="icon-7"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif