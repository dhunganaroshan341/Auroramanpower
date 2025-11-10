@extends('Admin.layout.master')

@section('content')
<div class="container-fluid">
    <div class="main-panel">
        <div class="content">

            {{-- Top Section: User/Admin Stats --}}
            <div class="row">
                <div class="col-12">
                    <div class="statistics-details d-flex align-items-center justify-content-between flex-wrap">

                        <div class="mb-3">
                            <p class="statistics-title">Total Users</p>
                            <h3 class="rate-percentage">{{ $totaluser }}</h3>
                        </div>
                        <div class="mb-3">
                            <p class="statistics-title">Admins</p>
                            <h3 class="rate-percentage">{{ $admin }}</h3>
                        </div>
                        <div class="mb-3">
                            <p class="statistics-title">Users</p>
                            <h3 class="rate-percentage">{{ $user }}</h3>
                        </div>

                    </div>
                </div>
            </div>
            {{-- End Top Section --}}

            {{-- Stats Chart --}}
            <div class="row mt-3">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card card-rounded">
                        <div class="card-body">
                            <h4 class="card-title card-title-dash">Dashboard Stats Chart</h4>
                            <h5 class="card-subtitle card-subtitle-dash">All Stats with Admin Links</h5>
                            <div class="mt-4">
                                <canvas id="dashboardStatsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Stats Chart --}}

            {{-- Stats Cards with Admin Links --}}
            <div class="row mt-4">
                @php
                    $stats = [
                        ['label' => 'Jobs', 'value' => $jobs, 'route' => route('admin.jobs.index')],
                        ['label' => 'Job Categories', 'value' => $jobCategories, 'route' => route('admin.job-categories.index')],
                        ['label' => 'Pending Applications', 'value' => $pendingApplications, 'route' => route('admin.job-applications.index')],
                        ['label' => 'Pages', 'value' => $pages, 'route' => route('admin.pages.index')],
                        ['label' => 'Banners', 'value' => $banners, 'route' => route('admin.page-banner.index')],
                        ['label' => 'Services', 'value' => $services, 'route' => route('admin.service.index')],
                        ['label' => 'Testimonials', 'value' => $testimonials, 'route' => route('admin.testimonial')],
                        ['label' => 'Achievements', 'value' => $achievements, 'route' => route('admin.achievements.index')],
                        ['label' => 'Clients', 'value' => $clients, 'route' => route('admin.client.index')],
                        ['label' => 'Gallery', 'value' => $gallery, 'route' => route('admin.gallery-albums.index')],
                        ['label' => 'Notices', 'value' => $notices, 'route' => route('admin.notice.index')],
                        ['label' => 'Blogs', 'value' => $blogs, 'route' => route('admin.post')],
                        ['label' => 'Newsletters', 'value' => $newsletters, 'route' => route('admin.newsletters.index')],
                    ];
                @endphp

                @foreach($stats as $stat)
                    <div class="col-6 col-md-4 col-xl-3 mb-3">
                        <a href="{{ $stat['route'] }}" class="text-decoration-none">
                            <div class="card shadow-sm rounded-3 border-light hover-shadow text-center p-3">
                                <p class="mb-2 text-muted">{{ $stat['label'] }}</p>
                                <h3 class="mb-0">{{ $stat['value'] }}</h3>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            {{-- End Stats Cards --}}

        </div>
    </div>
</div>

{{-- Chart Script --}}
<script>
    $(document).ready(function() {
        var ctx = document.getElementById('dashboardStatsChart').getContext('2d');
        var statsLabels = @json(array_column($stats, 'label'));
        var statsData = @json(array_column($stats, 'value'));

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: statsLabels,
                datasets: [{
                    label: 'Dashboard Stats',
                    data: statsData,
                    backgroundColor: statsLabels.map((_, i) => `rgba(${(i*30)%255}, ${(i*60)%255}, ${(i*90)%255}, 0.4)`),
                    borderColor: statsLabels.map((_, i) => `rgba(${(i*30)%255}, ${(i*60)%255}, ${(i*90)%255}, 1)`),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });
</script>
@endsection
