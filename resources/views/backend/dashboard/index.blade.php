@php
    use App\Enums\EnumUserRole;
@endphp

@extends('template.main')

@section('content')
    <div id="main-content">
             
        <div class="row d-flex justify-content-between align-items-center">
            <!-- Left Content (Start) -->
            <div class="col">
                <div class="page-heading">
                    <div class="page-title">
                        <h3>
                            Hello & {{ \App\Helpers\GreetingHelper::getGreeting() }}, {{ explode(' ', Auth::user()->name)[0] }}!
                        </h3>
                        <p class="text-subtitle text-muted">
                            Here's an overview of your activities.
                        </p>
                    </div>
                </div> 
            </div>
        
            <!-- Right Content (End) -->
            <div class="col text-end">
                <div class="page-heading">
                    <div class="page-title">
                        <button 
                            class="btn btn-icon border-spacing-0 border-0" 
                            data-bs-toggle="modal" 
                            data-bs-target="#filterModal"
                            aria-label="Open Filter Modal"
                        >
                            <i class="bx bx-sm bx-filter-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>        

        <!-- Filter Modal -->
        <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterModalLabel">Filter Options</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Start of Vertical Filter Form -->
                        <form action="{{ url()->current() }}" method="GET">
                            <div class="row g-3">
                                <!-- Start Date -->
                                <div class="col-12">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input 
                                        type="date" 
                                        id="start_date" 
                                        name="start_date" 
                                        class="form-control" 
                                        value="{{ request('start_date', \Carbon\Carbon::today()->subDays(6)->toDateString()) }}" 
                                    >
                                </div>
                                
                                <!-- End Date -->
                                <div class="col-12">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input 
                                        type="date" 
                                        id="end_date" 
                                        name="end_date" 
                                        class="form-control" 
                                        value="{{ request('end_date', \Carbon\Carbon::today()->toDateString()) }}" 
                                    >
                                </div>
                                
                                <!-- Subdays -->
                                <div class="col-12">
                                    <label for="subdays" class="form-label">Subdays</label>
                                    <select name="subdays" id="subdays" class="form-select">
                                        @for ($i = 1; $i <= 30; $i++)
                                            <option value="{{ $i }}" {{ request('subdays', 6) == $i ? 'selected' : '' }}>
                                                {{ $i }} day{{ $i > 1 ? 's' : '' }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                
                                <!-- User Assignment (Conditional for MASTER role) -->
                                @if (Auth::user()->roles->first()->name == EnumUserRole::MASTER->value)
                                    <div class="col-12">
                                        <label for="post_user_id" class="form-label">Assign to User</label>
                                        <select name="post_user_id" id="post_user_id" class="form-select">
                                            <option value="" {{ request('post_user_id', '') == '' ? 'selected' : '' }}>All Users</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" {{ request('post_user_id') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            
                                <!-- Submit Button -->
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                                </div>
                                
                                <!-- Clear Filters -->
                                <div class="col-12 text-center">
                                    <a href="{{ url()->current() }}" class="btn btn-secondary w-100">Clear Filters</a>
                                </div>
                            </div>
                        </form>
                        <!-- End of Vertical Filter Form -->
                    </div>
                </div>
            </div>
        </div>
        
        @php
            $labels = [];
            $data = []; 
            $colors = [];

            foreach ($historycalPostViews['week'] as $view) {
                $labels[] = $view['label'];
                $data[] = $view['total_views'];
                $colors[] = $view['colors'];
            }
        @endphp
    
        <div class="row">
            <div class="col-12">
                <section class="section">

                    <div class="row">
                        <!-- All Posts -->
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon purple mb-2">
                                                <i class='bx bx-file'></i>
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
                                                <i class='bx bx-calendar'></i>
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
                                                <i class='bx bx-pencil'></i>
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
                                                <i class='bx bx-check-circle'></i>
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
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4>Post Views</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-post-view"></div>
                            <p id="no-data-post-view" class="d-none text-center text-muted">No Data</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4>Popular Posts</h4>
                        </div>
                        <div class="card-body">
                            <!-- Table to display popular posts -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Views</th>
                                        <th>Published Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($mostViewedPosts as $mostViewedPost)
                                        <tr>
                                            <td>{{ $mostViewedPost->title }}</td>
                                            <td class="views-cell" data-views="{{ $mostViewedPost->total_views }}">{{ $mostViewedPost->total_views }}</td>
                                            <td>{{ \Carbon\Carbon::parse($mostViewedPost->published_at)->format('D d M, Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No Data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        @if (Auth::user()->roles->first()->name == EnumUserRole::MASTER->value)
            <div class="row">
                <div class="col-lg-6">
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h4>Operating Systems</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-visitor-os"></div>
                                <p id="no-data-visitor-os" class="d-none text-center text-muted">No Data</p>
                            </div>
                        </div>
                    </section>
                </div>
                
                <div class="col-lg-6">
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h4>Visitor Countries</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-visitor-countries"></div>
                                <p id="no-data-visitor-countries" class="d-none text-center text-muted">No Data</p>
                            </div>
                        </div>
                    </section>
                </div>
                
                <div class="col-lg-6">
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h4>Visitor Browsers</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-visitor-browsers"></div>
                                <p id="no-data-visitor-browsers" class="d-none text-center text-muted">No Data</p>
                            </div>
                        </div>
                    </section>
                </div>
                
                <div class="col-lg-6">
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h4>Visitor Devices</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-visitor-devices"></div>
                                <p id="no-data-visitor-devices" class="d-none text-center text-muted">No Data</p>
                            </div>
                        </div>
                    </section>
                </div>          
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<!-- Need: Apexcharts -->
<script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>

<script>
    function toggleChartVisibility(dataSeries, chartSelector, messageSelector) {
        const chartContainer = document.querySelector(chartSelector);
        const messageContainer = document.querySelector(messageSelector);

        if (!dataSeries || !dataSeries.some(value => value > 0)) {
            chartContainer.classList.add('d-none');
            messageContainer.classList.remove('d-none');
        } else {
            chartContainer.classList.remove('d-none');
            messageContainer.classList.add('d-none');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const charts = [
            {
                dataSeries: @json($data) || [],
                chartSelector: '#chart-post-view',
                messageSelector: '#no-data-post-view',
                options: {
                    chart: { type: 'bar', height: 300 },
                    series: [{ name: 'Views', data: @json($data) || [] }],
                    xaxis: { categories: @json($labels) || [] },
                    colors: @json($colors) || []
                }
            },
            {
                dataSeries: @json($historycalVisitorCountries['series']) || [],
                chartSelector: '#chart-visitor-countries',
                messageSelector: '#no-data-visitor-countries',
                options: {
                    chart: { type: 'donut', width: '100%', height: '350px' },
                    series: @json($historycalVisitorCountries['series']) || [],
                    labels: @json($historycalVisitorCountries['labels']) || [],
                    colors: @json($historycalVisitorCountries['colors']) || [],
                    legend: { position: 'bottom' },
                    plotOptions: { pie: { donut: { size: '30%' } } }
                }
            },
            {
                dataSeries: @json($historycalVisitorBrowsers['series']) || [],
                chartSelector: '#chart-visitor-browsers',
                messageSelector: '#no-data-visitor-browsers',
                options: {
                    chart: { type: 'donut', width: '100%', height: '350px' },
                    series: @json($historycalVisitorBrowsers['series']) || [],
                    labels: @json($historycalVisitorBrowsers['labels']) || [],
                    colors: @json($historycalVisitorBrowsers['colors']) || [],
                    legend: { position: 'bottom' },
                    plotOptions: { pie: { donut: { size: '30%' } } }
                }
            },
            {
                dataSeries: @json($historycalVisitorDevices['series']) || [],
                chartSelector: '#chart-visitor-devices',
                messageSelector: '#no-data-visitor-devices',
                options: {
                    chart: { type: 'donut', width: '100%', height: '350px' },
                    series: @json($historycalVisitorDevices['series']) || [],
                    labels: @json($historycalVisitorDevices['labels']) || [],
                    colors: @json($historycalVisitorDevices['colors']) || [],
                    legend: { position: 'bottom' },
                    plotOptions: { pie: { donut: { size: '30%' } } }
                }
            },
            {
                dataSeries: @json($historycalVisitorOS['series']) || [],
                chartSelector: '#chart-visitor-os',
                messageSelector: '#no-data-visitor-os',
                options: {
                    chart: { type: 'donut', width: '100%', height: '350px' },
                    series: @json($historycalVisitorOS['series']) || [],
                    labels: @json($historycalVisitorOS['labels']) || [],
                    colors: @json($historycalVisitorOS['colors']) || [],
                    legend: { position: 'bottom' },
                    plotOptions: { pie: { donut: { size: '30%' } } }
                }
            }
        ];

        charts.forEach(({ dataSeries, chartSelector, messageSelector, options }) => {
            const chart = new ApexCharts(document.querySelector(chartSelector), options);
            chart.render().then(() => toggleChartVisibility(dataSeries, chartSelector, messageSelector));
        });
    });
</script>

<script>
    function formatNumber(num) {
        if (num >= 1e6) {
            return (num / 1e6).toFixed(1) + 'M';
        } else if (num >= 1e3) {
            return (num / 1e3).toFixed(1) + 'K';
        } else {
            return num;
        }
    }

    document.querySelectorAll('.views-cell').forEach(cell => {
        const views = parseInt(cell.getAttribute('data-views'), 10);
        cell.textContent = formatNumber(views);
    });
</script>
@endpush