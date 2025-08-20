<!-- testimonial-style-two -->
<section class="testimonial-style-two pt_70 pb_120">
    <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-17.png') }}')"></div>
    <div class="auto-container">
        <div class="sec-title centred pb_60 sec-title-animation animation-style2">
            <span class="sub-title mb_10 title-animation">Testimonials</span>
            <h2 class="title-animation">Love From Users</h2>
        </div>

        <div class="two-item-carousel owl-carousel owl-theme owl-nav-none">
            @foreach ($testimonials as $testimonial)
                <div class="testimonial-block-two">
                    <div class="inner-box">
                        <div class="icon-box">
                            <img src="{{ asset('assets/images/icons/icon-11.png') }}" alt="">
                        </div>
                        <div class="author-box">
                            <figure class="thumb-box">
                                <img src="{{ $testimonial->image_url ?? asset('template/yatri_world/main-file/images/User.png') }}"
                                    alt="{{ $testimonial->name }}">
                            </figure>
                            <h4>{{ $testimonial->name }}</h4>
                            <span class="designation">{{ $testimonial->designation }}</span>
                        </div>
                        <p>{{ $testimonial->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- testimonial-style-two end -->
