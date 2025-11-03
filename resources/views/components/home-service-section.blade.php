<section class="industries-style-two pt_120 pb_90">
    <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-3.png') }}')"></div>
    <div class="auto-container">
        <div class="sec-title light centred pb_60 sec-title-animation animation-style2">
            <span class="sub-title mb_10 title-animation">Our Expertise</span>
            <h2 class="title-animation">Services We Provide</h2>
        </div>

        <div class="row clearfix">
            @forelse($categories as $category)
                <div class="col-lg-4 col-md-6 col-sm-12 industries-block">
                    <div class="industries-block-two">
                        <div class="inner-box">
                            <div class="icon-box">
                                <i class="{{ $category->icon_class ?? 'fa-solid fa-briefcase' }}"></i>
                            </div>
                            <h3>
                                <a href="{{ route('index') }}">{{ $category->name }}</a>
                            </h3>
                            <p>{{ $category->description }}</p>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Fallback content if no categories --}}
                <div class="col-12 text-center">
                    <p>No services available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
