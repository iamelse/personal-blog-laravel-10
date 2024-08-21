@extends('template.main')

@section('content')
<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Hello & {{ \App\Helpers\GreetingHelper::getGreeting() }}, {{ explode(' ', Auth::user()->name)[0] }}!</h3>
                    <p class="text-subtitle text-muted">Overview of your activities and quick access to main features.</p>
                </div>                
            </div>
        </div>
    </div>

    @php
        $labels = [];
        $data = [];

        foreach ($historycalPostViews['week'] as $view) {
            $labels[] = (new DateTime($view->view_date))->format('M j, Y');
            $data[] = $view->total_views;
        }
    @endphp
    
    <div class="row">
        <div class="col-12 col-lg-9">
            <section class="section">
                <div class="row">
                    <!-- All Posts -->
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon purple mb-2">
                                            <i class='bx bx-file'></i> <!-- Represents posts or documents -->
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">All Post</h6>
                                        <h6 class="font-extrabold mb-0">{{ $totalPosts->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <!-- Scheduled Posts -->
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon orange mb-2">
                                            <i class='bx bx-calendar'></i> <!-- Represents scheduled events or calendar -->
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Scheduled Post</h6>
                                        <h6 class="font-extrabold mb-0">{{ $scheduledPosts->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <!-- Drafted Posts -->
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon green mb-2">
                                            <i class='bx bx-pencil'></i> <!-- Represents drafts or editing -->
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Drafted Post</h6>
                                        <h6 class="font-extrabold mb-0">{{ $draftedPosts->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <!-- Published Posts -->
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon red mb-2">
                                            <i class='bx bx-check-circle'></i> <!-- Represents published or completed -->
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Published Post</h6>
                                        <h6 class="font-extrabold mb-0">{{ $publishedPosts->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </section>
            
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4>Post Views</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-post-view"></div>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-12 col-lg-3">
            <section class="section">
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            <h4>Countries</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-visitor-countries"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<!-- Need: Apexcharts -->
<script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>

<script>
    const labels = @json($labels) || [];
    const data = @json($data) || [];
    
    const historycalVisitorCountries = @json($historycalVisitorCountries) || {};

    const optionsPostView = {
        chart: {
            type: 'bar',
            height: 300
        },
        series: [{
            name: 'Views',
            data: data
        }],
        xaxis: {
            categories: labels
        },
        colors: ['#435ebe']
    };

    const optionsVisitorCountries = {
        chart: {
            type: 'donut',
            width: '100%',
            height: '350px'
        },
        series: historycalVisitorCountries.series || [],
        labels: historycalVisitorCountries.labels || [],
        colors: ['#435ebe', '#55c2e8', '#55c6e2'],
        legend: {
            position: 'bottom'
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '30%'
                }
            }
        }
    };

    document.addEventListener('DOMContentLoaded', function () {
        const chartPostView = new ApexCharts(document.querySelector('#chart-post-view'), optionsPostView);
        const chartVisitorCountries = new ApexCharts(document.querySelector('#chart-visitor-countries'), optionsVisitorCountries);
        
        chartPostView.render();
        chartVisitorCountries.render();
    });
</script>
@endpush