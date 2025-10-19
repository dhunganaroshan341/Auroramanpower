<section class="industries-style-two pt_120 pb_90">
    <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-3.png') }}')"></div>
    <div class="auto-container">
        <div class="sec-title light centred pb_60 sec-title-animation animation-style2">
            <span class="sub-title mb_10 title-animation">Our Expertise</span>
            <h2 class="title-animation">Services We Provide</h2>
        </div>
        <div class="row clearfix">
            @if($services->isNotEmpty())
                @foreach($services as $service)
                    <div class="col-lg-4 col-md-6 col-sm-12 industries-block">
                        <div class="industries-block-two">
                            <div class="inner-box">
                                <div class="icon-box"><i class="{{ $service->icon_class ?? 'icon-15' }}"></i></div>
                                <h3><a href="{{ route('jobs', ['category'=>$service->title]) }}">{{ $service->name }}</a></h3>
                                <p> {{ \Illuminate\Support\Str::words($service->description ?? '', 5, '...') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                {{-- Fallback static services --}}
                <div class="col-lg-4 col-md-6 col-sm-12 industries-block">
                    <div class="industries-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-15"></i></div>
                            <h3><a href="{{ route('index') }}">Logistics</a></h3>
                            <p>Drivers, Operators, Mechanics</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 industries-block">
                    <div class="industries-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-11"></i></div>
                            <h3><a href="{{ route('index') }}">Construction</a></h3>
                            <p>Engineers, Surveyors, Technicians</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 industries-block">
                    <div class="industries-block-two">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-10"></i></div>
                            <h3><a href="{{ route('index') }}">Hospitality</a></h3>
                            <p>Managers, Waiters, Housekeepers</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
