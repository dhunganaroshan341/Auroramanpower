<!-- Chairman's Message Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <!-- Chairman Image -->
            <div class="col-md-4 mb-4 mb-md-0 text-center">
                <img src="{{ asset('uploads/' . $content->image1) }}" alt="Chairman" class="img-fluid rounded shadow-lg"
                    style="max-height: 350px; object-fit: cover;">
            </div>

            <!-- Chairman Message -->
            <div class="col-md-8">
                <h2 class="fw-bold mb-3">Message from the Chairman</h2>
                <div class="text-muted" style="line-height: 1.8;">
                    {!! $content->content !!}
                </div>
            </div>
        </div>
    </div>
</section>
