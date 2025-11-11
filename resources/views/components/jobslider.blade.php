<section class="job-slider centred pt_110 pb_120">
    <div class="auto-container text-center">
        <div class="title-text mb_50">
            <h3>Latest Job Vacancies</h3>
        </div>

        <div class="job-carousel owl-carousel owl-theme owl-dots-none owl-nav-none justify-content-center">
            @forelse($jobs as $job)
            <div class="job-item">
                <figure class="job-thumb mb_20">
                    <a href="{{ route('jobBySlug', ['slug' => $job->slug]) }}">
                        <img src="{{ asset($job->image ?? 'assets/images/default-job.png') }}" alt="{{ $job->title }}"
                            class="img-fluid mx-auto d-block"
                            style="width: 140px; height: 140px; object-fit: cover; border-radius: 12px;">
                    </a>
                </figure>

                <h5 class="fw-semibold mb_5">
                    <a class="text-theme-primary" href="{{ route('jobBySlug', ['slug' => $job->slug]) }}">
                        {{ \Illuminate\Support\Str::limit($job->title, 28) }}
                    </a>
                </h5>

                <p class="text-muted small mb_2">
                    {{ $job->ourCountry->name ?? 'N/A' }}
                </p>

                <p class="small text-dark">
                    {{ $job->salary ?? 'Negotiable' }}
                </p>
            </div>
            @empty
            <p>No job vacancies available at the moment.</p>
            @endforelse
        </div>
    </div>
</section>

@push('scripts')
<script>
    $(document).ready(function () {
        $(".job-carousel").owlCarousel({
            center: true,
            loop: true,
            margin: 40,
            autoplay: true,
            autoplayTimeout: 2800,
            autoplayHoverPause: true,
            smartSpeed: 700,
            responsive: {
                0: { items: 1 },
                600: { items: 2 },
                992: { items: 3 },
                1200: { items: 4 }
            }
        });
    });
</script>
@endpush

@push('styles')
<style>
    .job-item {
        text-align: center;
    }

    .job-item a {
        text-decoration: none;
    }

    .job-item h5 a:hover {
        color: var(--theme-color, #ff6600);
    }

    .job-thumb img {
        transition: transform 0.35s ease, filter 0.35s ease;
    }

    .job-thumb:hover img {
        transform: scale(1.08);
        filter: brightness(1.1);
    }

    .job-item p {
        margin-bottom: 0.2rem;
    }

    .job-carousel .owl-stage {
        display: flex;
        align-items: center;
    }
</style>
@endpush