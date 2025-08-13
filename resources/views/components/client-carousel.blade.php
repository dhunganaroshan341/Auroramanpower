<div class="partners">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="title" style="padding-bottom:1px">Our Partners</h2>
        </div>

        <div class="attract-slider owl-carousel">
            @foreach ($clients as $client)
                <div class="client-logo item">
                    <img src="{{ $client->image_url ?? asset('template/yatri_world/main-file/images/clients/logo-01.png') }}"
                        alt="client">
                </div>
            @endforeach
        </div>
    </div>
</div>
@push('styles')
    <style>
        .slick-slide img {
            display: block;
            width: 100%;
            height: 130px;
            object-fit: contain;
        }

        .client-logo.item.slick-slide {
            background: white;
            margin: 0 10px 20px;
        }
    </style>
@endpush
