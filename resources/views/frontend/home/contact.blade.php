@extends('frontend.layouts.layout')

@php
    $title = 'Contact us';
    $subTitle = 'Contact us';
    $css =
        '<link href="' .
        asset('assets/css/module-css/page-title.css') .
        '" rel="stylesheet">
            <link href="' .
        asset('assets/css/module-css/contact.css') .
        '" rel="stylesheet">
            <link href="' .
        asset('assets/css/module-css/subscribe.css') .
        '" rel="stylesheet">
            <link href="' .
        asset('assets/css/module-css/footer.css') .
        '" rel="stylesheet">';
@endphp

@section('content')
    <!-- contact-section -->
    <section class="contact-section pt_110 pb_30">
        <div class="auto-container">
            <div class="inner-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12 col-sm-12 info-column">
                        <div class="info-box">
                            <h3>Contact Information</h3>
                            <div class="single-item">
                                <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-27.png') }}" alt="">
                                </div>
                                <h4>Corporate Office</h4>
                                <p>Kupandol-10, Lalitpur, Nepal</p>
                            </div>
                            <div class="single-item">
                                <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-28.png') }}"
                                        alt=""></div>
                                <h4>Email Address</h4>
                                <p><a href="mailto:aurorashrpl@gmail.com">aurorashrpl@gmail.com</a><br /><a
                                        href="mailto:info@auroranepal.com.np">info@auroranepal.com.np</a></p>
                            </div>
                            <div class="single-item">
                                <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-29.png') }}"
                                        alt=""></div>
                                <h4>Phone Number</h4>
                                <p><a href="tel:+97715261063">+977-01-5261063</a><br /><a
                                        href="tel:+97715260810">+977-01-5260810</a></p>
                            </div>
                            <div class="single-item">
                                <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-27.png') }}"
                                        alt=""></div>
                                <h4>Business Hours</h4>
                                <p>Sunday - Friday: 10:00 AM - 06:00 PM<br />Saturday: Closed</p>
                            </div>
                            <div class="single-item">
                                <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-27.png') }}"
                                        alt=""></div>
                                <h4>License Information</h4>
                                <p>License No.: 736/064/065<br />Registration No.: 47745/064/065</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 content-column">
                        <div class="form-inner">
                            <h3>Get In Touch</h3>
                            <p>Aurora Human Resource (P) Ltd. is an international manpower agency and one of the pioneers in
                                manpower recruiting. We are committed to offering true customer-focused solutions in the
                                field of Human Resource recruiting business.</p>
                            <form method="post" action="#" id="contact-form">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <label>Name <span>*</span></label>
                                        <input type="text" name="username" placeholder="Your Full Name" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <label>Phone <span>*</span></label>
                                        <input type="text" name="phone" placeholder="Your Phone Number" required>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>Email Address <span>*</span></label>
                                        <input type="email" name="email" placeholder="Your Email Address" required>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>Subject <span>*</span></label>
                                        <input type="text" name="subject" placeholder="Subject of your inquiry" required>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>Write Message <span>*</span></label>
                                        <textarea name="message" placeholder="Please describe your requirements or inquiry in detail..."></textarea>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one" name="submit-form">Send
                                            Message</button>
                                    </div>
                                </div>
                            </form>

                            <div class="recent-vacancies" style="margin-top: 30px;">
                                <h4>Recent Vacancies</h4>
                                <ul style="list-style: none; padding: 0;">
                                    <li style="margin-bottom: 8px;"><a href="#"
                                            style="text-decoration: none; color: #333;">• Vacancy in Qatar</a></li>
                                    <li style="margin-bottom: 8px;"><a href="#"
                                            style="text-decoration: none; color: #333;">• Vacancy in UAE</a></li>
                                    <li style="margin-bottom: 8px;"><a href="#"
                                            style="text-decoration: none; color: #333;">• Vacancy in Malaysia</a></li>
                                    <li style="margin-bottom: 8px;"><a href="#"
                                            style="text-decoration: none; color: #333;">• Vacancy in Saudi</a></li>
                                    <li style="margin-bottom: 8px;"><a href="#"
                                            style="text-decoration: none; color: #333;">• Vacancy in Japan</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-section end -->

    <!-- google-map -->
    <section class="google-map pb_80">
        <div class="auto-container">
            <div class="inner-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55945.16225505631!2d-73.90847969206546!3d40.66490264739892!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1601263396347!5m2!1sen!2sbd"
                    width="100%" height="500" frameborder="0" style="border:0; width: 100%" allowfullscreen=""
                    aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </section>
    <!-- google-map end -->
@endsection
