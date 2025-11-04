<footer class="main-footer home-2">
    <div class="widget-section position-relative pt-80 pb-20">
        <div class="auto-container">
            <div class="row gy-4 justify-content-center">

                <!-- About Us -->
                <div class="col-lg-4 col-md-6 col-sm-12 footer-column text-center text-md-start">
                    <div class="footer-widget logo-widget me-lg-4">
                        <figure class="footer-logo mb-3">
                            <a href="{{ route('index') }}">
                                <img src="{{ asset('assets/images/logo-bg.png') }}" alt="Aurora Logo" class="img-fluid" style="max-width: 180px;">
                            </a>
                        </figure>
                        <p class="small">
                            Aurora Human Resource (P) Ltd. is an international manpower agency, one of the pioneers in
                            recruiting, founded with the core belief of offering true customer-focused solutions in
                            Human Resource recruiting, backed by a dedicated and experienced team.
                        </p>
                    </div>
                </div>

                <!-- Contact Us -->
                <div class="col-lg-4 col-md-6 col-sm-12 footer-column text-center text-md-start">
                    <div class="footer-widget links-widget">
                        <div class="widget-title mb-3">
                            <h4>Contact Us</h4>
                        </div>
                        <ul class="list-unstyled mb-0 small" style="line-height: 1.8;">
                            <li><strong>Address:</strong> Kupandol-10, Lalitpur, Nepal</li>
                            <li><strong>Phone:</strong> +977-01-5261063 / 5260810</li>
                            <li><strong>Email:</strong>
                                <a href="mailto:aurorashrpl@gmail.com" class="text-decoration-none text-white d-block">
                                    aurorashrpl@gmail.com
                                </a>
                                <a href="mailto:info@auroranepal.com.np" class="text-decoration-none text-white d-block">
                                    info@auroranepal.com.np
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Recent Vacancies -->
                <div class="col-lg-4 col-md-6 col-sm-12 footer-column text-center text-md-start">
                    <div class="footer-widget links-widget">
                        <div class="widget-title mb-3">
                            <h4>Recent Vacancies</h4>
                        </div>
                        <ul class="list-unstyled mb-0 small">
                            @php
                                $recentVacancies = getRecentVacancyByCountryForFooter();
                            @endphp
                            @forelse($recentVacancies->take(4) as $vacancy)
                                <li class="mb-2">
                                    <a href="{{ route('jobById', ['id' => $vacancy->id]) }}" class="text-decoration-none text-white">
                                        Vacancy in {{ $vacancy->ourCountry->name }}
                                    </a>
                                </li>
                            @empty
                                <li><a href="#" class="text-decoration-none text-white">Vacancy in Qatar</a></li>
                                <li><a href="#" class="text-decoration-none text-white">Vacancy in UAE</a></li>
                                <li><a href="#" class="text-decoration-none text-white">Vacancy in Malaysia</a></li>
                                <li><a href="#" class="text-decoration-none text-white">Vacancy in Saudi</a></li>
                            @endforelse
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom mt-4 pt-3 pb-3 border-top border-secondary">
        <div class="auto-container">
            <div class="bottom-inner d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 text-center text-md-start">
                <div class="copyright small">
                    <p class="mb-0">
                        &copy; 2025 <a href="{{ route('index') }}" class="text-decoration-none text-white fw-bold">Aurora</a>.
                        All rights reserved. | Developed by
                        <a href="https://realminfotek.com/" class="text-decoration-none text-white fw-bold">Realminfotech Pvt. Ltd</a>
                    </p>
                </div>

                <ul class="social-links d-flex justify-content-center justify-content-md-end gap-3 mb-0 list-unstyled">
                    <li><h6 class="mb-0 me-2">Follow Us:</h6></li>
                    <li><a href="#" class="text-white"><i class="icon-22"></i></a></li>
                    <li><a href="#" class="text-white"><i class="icon-23"></i></a></li>
                    <li><a href="#" class="text-white"><i class="icon-24"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Additional responsive fix -->
<style>
    @media (max-width: 767px) {
        .footer-widget h4 {
            font-size: 18px;
        }
        .footer-widget p,
        .footer-widget li {
            font-size: 14px;
        }
        .footer-logo img {
            max-width: 140px !important;
        }
        .footer-bottom {
            text-align: center;
        }
    }
</style>
