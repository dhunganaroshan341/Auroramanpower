<footer class="main-footer home-2">
    <div class="widget-section p_relative pt_80 pb_20">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- About Us -->
                <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget logo-widget mr_30">
                        <figure class="footer-logo mb_20">
                            <a href="{{ route('index') }}">
                                <img src="{{ asset('assets/images/logo-bg.png') }}" alt="Aurora Logo">
                            </a>
                        </figure>
                        <p>
                            Aurora Human Resource (P) Ltd. is an international manpower agency, one of the pioneers in
                            recruiting, founded with the core belief of offering true customer-focused solutions in
                            Human Resource recruiting, backed by a dedicated and experienced team.
                        </p>
                        <a href="{{ route('company-overview') }}" class="theme-btn btn-one">VIEW MORE</a>
                    </div>
                </div>

                <!-- Contact Us -->
                <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget links-widget">
                        <div class="widget-title">
                            <h4>Contact Us</h4>
                        </div>
                        <div class="widget-content">
                            <ul class="links-list clearfix" style="line-height: 1.8;">
                                <li><strong>Address:</strong> Kupandol-10, Lalitpur, Nepal</li>
                                <li><strong>Phone 1:</strong> +977-01-5261063</li>
                                <li><strong>Phone 2:</strong> +977-01-5260810</li>
                                <li><strong>Email 1:</strong> 
                                    <a href="mailto:aurorashrpl@gmail.com" style="color: inherit; text-decoration: none;">
                                        aurorashrpl@gmail.com
                                    </a>
                                </li>
                                <li><strong>Email 2:</strong> 
                                    <a href="mailto:info@auroranepal.com.np" style="color: inherit; text-decoration: none;">
                                        info@auroranepal.com.np
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Recent Vacancies -->
                <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget links-widget">
                        <div class="widget-title">
                            <h4>Recent Vacancies</h4>
                        </div>
                        <div class="widget-content">
                            <ul class="links-list clearfix">
                                @php
                                    $recentVacancies = getRecentVacancyByCountryForFooter();
                                @endphp
                                @forelse($recentVacancies->take(4) as $vacancy)
                                    <li>
                                        <a href="{{ route('jobById', ['id' => $vacancy->id]) }}">
                                            Vacancy in {{ $vacancy->ourCountry->name }}
                                        </a>
                                    </li>
                                @empty
                                    {{-- Fallback vacancies --}}
                                    <li><a href="#">Vacancy in Qatar</a></li>
                                    <li><a href="#">Vacancy in UAE</a></li>
                                    <li><a href="#">Vacancy in Malaysia</a></li>
                                    <li><a href="#">Vacancy in Saudi</a></li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="bottom-inner d-flex justify-content-between align-items-center">
                <div class="copyright">
                    <p>
                        Copyright &copy; 2025 
                        <a href="{{ route('index') }}">Aurora</a>. All rights reserved. | 
                        Developed by 
                        <a href="https://realminfotek.com/">Realminfotech Pvt. Ltd</a>
                    </p>
                </div>

                <ul class="social-links d-flex">
                    <li><h5>Follow Us On:</h5></li>
                    <li><a href="#"><i class="icon-22"></i></a></li>
                    <li><a href="#"><i class="icon-23"></i></a></li>
                    <li><a href="#"><i class="icon-24"></i></a></li>
                    {{-- <li><a href="#"><i class="icon-25"></i></a></li> --}}
                </ul>
            </div>
        </div>
    </div>
</footer>
