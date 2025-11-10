<section class="job-slider centred pt_110 pb_120">
    <div class="auto-container">
        <div class="title-text mb_40">
            <h3>Latest Job Vacancies</h3>
        </div>

        <div class="job-carousel owl-carousel owl-theme owl-dots-none owl-nav-none">
            @forelse($jobs as $job)
            <div class="job-card p-4 shadow-sm rounded">
                <figure class="job-thumb mb_20">
                    <a href="{{ route('jobBySlug',['slug'=> $job->slug]) }}">
                        <img src="{{ asset($job->image ?? 'assets/images/default-job.png') }}" alt="{{ $job->title }}"
                            class="rounded img-fluid">
                    </a>
                </figure>
                <h4 class="mb_10">
                    <a href="{{ route('jobBySlug', $job->id) }}">{{ $job->title }}</a>
                </h4>
                <p class="text-muted mb_10">
                    {{ $job->ourCountry->name ?? 'N/A' }} •
                    {{ $job->salary ?? 'Negotiable' }}
                </p>
                <a href="{{ route('jobBySlug', $job->id) }}" class="theme-btn btn-sm">
                    View Details
                </a>
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
            loop: true,
            margin: 20,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: { items: 1 },
                600: { items: 2 },
                1000: { items: 3 }
            }
        });
    });
</script>
@endpush