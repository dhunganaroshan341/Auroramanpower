<section class="page-title centred pt_110">
    <div class="auto-container">
        <div class="content-box">
            <h1>{{ $title ?? '' }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li>-</li>
                <li>{{ $subTitle ?? '' }}</li>
            </ul>
        </div>
    </div>
</section>
