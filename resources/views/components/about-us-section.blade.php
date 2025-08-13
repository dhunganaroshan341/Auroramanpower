<section class="about-us">
    <div class="container">
        <div class="about-image-box">
            <div class="row d-flex align-items-center justify-content-between">

                <!-- Left Text Content -->
                <div class="col-lg-6">
                    <div class="about-content">
                        <h2 class="mb-1 blue font-weight-normal">
                            {{ $aboutContent->title1 ?? 'About Om Mundum Treks' }}
                        </h2>
                        <h3>
                            {{ $aboutContent->title2 ?? 'Extraordinary Journeys Beyond the Ordinary' }}
                        </h3>
                        {{-- <p class="mb-3">
                            {!! $aboutContent->content ??
                                'At Om Mundum Treks, we believe travel is more than just a journey—it\'s a life-changing experience. We offer unique adventures that take you off the beaten path, showcasing Nepal\'s breathtaking mountains, rich Kirati culture, and pristine hidden trails. Specializing in the newly opened Mundum Trail, we provide authentic cultural immersion experiences in eastern Nepal\'s untouched wilderness. Our carefully crafted expeditions connect you with indigenous Rai communities, ancient traditions, and spectacular Himalayan landscapes that few travelers ever witness. Every trek is designed with purpose—to create meaningful connections between adventurers and Nepal\'s most preserved cultural heritage while supporting local communities and sustainable tourism practices.' !!}
                        </p> <p class="mb-3"> --}}
                        {!! $aboutContent->content ??
                            'At Om Mundum Treks, we believe travel is more than just a journey—it\'s a life-changing experience. We offer unique adventures that take you off the beaten path, showcasing Nepal\'s breathtaking mountains, rich Kirati culture, and pristine hidden trails. Specializing in the newly opened Mundum Trail, we provide authentic cultural immersion experiences in eastern Nepal\'s untouched wilderness. Our carefully crafted expeditions connect you with indigenous Rai communities, ancient traditions, and spectacular Himalayan landscapes that few travelers ever witness. Every trek is designed with purpose—to create meaningful connections between adventurers and Nepal\'s most preserved cultural heritage while supporting local communities and sustainable tourism practices.' !!}
                        </p>
                        <div class="about-featured mb-0">
                            {{-- @if ($aboutContent->short_desc1)
                                {!! $aboutContent->short_desc1 !!}
                            @else --}}
                            <ul>
                                <li>Safety Travel System</li>
                                <li>Budget-Friendly Tour</li>
                                <li>Expert Trip Planning</li>
                                <li>Fast Communication</li>
                                <li>Right Solution & Guide</li>
                                <li>24/7 Customer Support</li>
                            </ul>
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>

                <!-- Right Image -->
                <div class="col-lg-6">
                    <div class="about-image">
                        <img alt="about image"
                            src="{{ asset($aboutContent->image1 ?? 'template/yatri_world/main-file/images/destination/lumbini.jpg') }}" />
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- about-us1 (Mission & Vision) starts -->
<section class="about-us1 bg-grey pb-6">
    <div class="container">
        <div class="about-us1-inner pt-5 pb-8">
            <div class="about-image-box">
                <div class="row d-flex align-items-center justify-content-between">

                    <!-- Left Text Content -->
                    <div class="col-lg-6">
                        <div class="about-content">
                            <h2>{{ $missionVision->title1 ?? 'Our Mission & Vision' }}</h2>

                            <p class="mb-2">
                                {!! $missionVision->description1 ?? '' !!}
                            </p>

                            <div class="about-featured mb-0">
                                <ul>
                                    @if (isset($missionVision->description2) && $missionVision->description2 != null)
                                        {!! $missionVision->description2 !!}
                                    @else
                                        <li>Authentic Experiences</li>
                                        <li>Safety & Excellence</li>
                                        <li>Sustainable Tourism</li>
                                        <li>Customer Satisfaction</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Right Images -->
                    <div class="col-lg-6">
                        <div class="about-image-main">
                            <div class="row">

                                <div class="col-md-6 mt-4 mb-4">
                                    <img alt="mission vision image 1"
                                        src="{{ asset($missionVision->image1 ?? 'template/yatri_world/main-file/images/destination/tibet-vertical.jpg') }}" />
                                </div>

                                <div class="col-md-6">
                                    <img alt="mission vision image 2"
                                        src="{{ asset($missionVision->image2 ?? 'template/yatri_world/main-file/images/destination/mountain-portrait.jpg') }}" />
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- why us section included -->
            @include('components.why-us-section')

        </div>
    </div>
</section>
