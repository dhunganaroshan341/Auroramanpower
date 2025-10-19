@if ($testimonials->isNotEmpty())
    {{-- ✅ Dynamic testimonials (new design) --}}
    <section class="testimonial-section pt_120 pb_90">
        <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-3.png') }}')"></div>
        <div class="auto-container">
            <div class="sec-title light centred pb_60 sec-title-animation animation-style2">
                <span class="sub-title mb_10 title-animation">Testimonials</span>
                <h2 class="title-animation">Words From Clients</h2>
            </div>
            <div class="three-item-carousel owl-carousel owl-theme owl-dots-none owl-nav-none">
                @foreach ($testimonials as $testimonial)
                    <div class="testimonial-block-one">
                        <div class="inner-box">
                            <div class="shape"
                                style="background-image: url('{{ asset('assets/images/shape/shape-7.png') }}')">
                            </div>
                            <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-10.png') }}" alt=""></div>
                            <div class="author-box">
                                <figure class="thumb-box">
                                    <img src="{{ $testimonial->image_url ?? asset('assets/images/resource/default-user.png') }}" alt="{{ $testimonial->name }}">
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
@else
    {{-- 🧱 Static fallback (old design) --}}
    <section class="testimonial-style-two pt_70 pb_120">
        <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-17.png') }}')"></div>
        <div class="auto-container">
            <div class="sec-title centred pb_60 sec-title-animation animation-style2">
                <span class="sub-title mb_10 title-animation">Testimonials</span>
                <h2 class="title-animation">Love From Users</h2>
            </div>
            <div class="two-item-carousel owl-carousel owl-theme owl-nav-none">
                {{-- Repeat your old static blocks here --}}
                <div class="testimonial-block-two">
                    <div class="inner-box">
                        <div class="icon-box">
                            <img src="{{ asset('assets/images/icons/icon-11.png') }}" alt="">
                        </div>
                        <div class="author-box">
                            <figure class="thumb-box">
                                <img src="{{ asset('assets/images/resource/testimonial-1.png') }}" alt="Ashitaka Dai">
                            </figure>
                            <h4>Ashitaka Dai</h4>
                            <span class="designation">Art Director</span>
                        </div>
                        <p>Company and was impressed by the main personalized approach of their recruitment team. They kept me informed at every stage.</p>
                    </div>
                </div>
                {{-- Add more static blocks as needed --}}
            </div>
        </div>
    </section>
@endif
