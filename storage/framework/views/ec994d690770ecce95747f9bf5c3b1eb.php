<?php
    use App\Enums\EnumUserRole;
?>



<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>
                            Hello & <?php echo e(\App\Helpers\GreetingHelper::getGreeting()); ?>, <?php echo e(explode(' ', Auth::user()->name)[0]); ?>!
                        </h3>
                        <p class="text-subtitle text-muted">
                            Here overview of your activities.
                        </p>
                    </div>                
                </div>
            </div>
        </div>             
        
        <?php
            $labels = [];
            $data = []; 
            $colors = [];

            foreach ($historycalPostViews['week'] as $view) {
                $labels[] = $view['label'];
                $data[] = $view['total_views'];
                $colors[] = $view['colors'];
            }
        ?>
    
        <div class="row">
            <div class="col-12">
                <section class="section">

                    <div class="container mb-3">
                        <div class="row align-items-center">
                            <form action="<?php echo e(url()->current()); ?>" method="GET" class="row gx-2">
                                <div class="col">
                                    <!-- Start Date label and input -->
                                    <label for="start_date" class="form-label text-sm">Start Date</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control form-control-sm" value="<?php echo e(request('start_date', \Carbon\Carbon::today()->subDays(6)->toDateString())); ?>">
                                </div>
                        
                                <div class="col">
                                    <!-- End Date label and input -->
                                    <label for="end_date" class="form-label text-sm">End Date</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control form-control-sm" value="<?php echo e(request('end_date', \Carbon\Carbon::today()->toDateString())); ?>">
                                </div>
                        
                                <div class="col">
                                    <!-- Subdays label and select input -->
                                    <label for="subdays" class="form-label text-sm">Subdays</label>
                                    <select name="subdays" id="subdays" class="form-select form-select-sm">
                                        <?php for($i = 1; $i <= 30; $i++): ?>
                                            <option value="<?php echo e($i); ?>" <?php echo e(request('subdays', 6) == $i ? 'selected' : ''); ?>>
                                                <?php echo e($i); ?> day<?php echo e($i > 1 ? 's' : ''); ?>

                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <?php if(Auth::user()->roles->first()->name == EnumUserRole::MASTER->value): ?>
                                    <div class="col">
                                        <!-- User label and select input -->
                                        <label for="post_user_id" class="form-label text-sm">Assign to User</label>
                                        <select name="post_user_id" id="post_user_id" class="form-select form-select-sm">
                                            <!-- Option for 'All Users' (default) -->
                                            <option value="" <?php echo e(request('post_user_id', '') == '' ? 'selected' : ''); ?>>All Users</option>
                                            
                                            <!-- Loop through users -->
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($user->id); ?>" <?php echo e(request('post_user_id') == $user->id ? 'selected' : ''); ?>>
                                                    <?php echo e($user->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                <?php endif; ?>                   
                        
                                <div class="col-auto">
                                    <!-- Submit button -->
                                    <label class="form-label d-block">&nbsp;</label> <!-- Spacer for alignment -->
                                    <button type="submit" class="btn btn-sm btn-primary mb-3">Submit</button>
                                </div>
                        
                                <div class="col-auto">
                                    <!-- Clear Filter button -->
                                    <label class="form-label d-block">&nbsp;</label> <!-- Spacer for alignment -->
                                    <a href="<?php echo e(url()->current()); ?>" class="btn btn-sm btn-secondary mb-3">Clear Filter</a>
                                </div>
                            </form>
                        </div>
                    </div>

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
                                            <h6 class="font-extrabold mb-0"><?php echo e($totalPosts->count()); ?></h6>
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
                                            <h6 class="font-extrabold mb-0"><?php echo e($scheduledPosts->count()); ?></h6>
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
                                            <h6 class="font-extrabold mb-0"><?php echo e($draftedPosts->count()); ?></h6>
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
                                            <h6 class="font-extrabold mb-0"><?php echo e($publishedPosts->count()); ?></h6>
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
                                    <?php $__empty_1 = true; $__currentLoopData = $mostViewedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mostViewedPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($mostViewedPost->title); ?></td>
                                            <td class="views-cell" data-views="<?php echo e($mostViewedPost->total_views); ?>"><?php echo e($mostViewedPost->total_views); ?></td>
                                            <td><?php echo e(\Carbon\Carbon::parse($mostViewedPost->published_at)->format('D d M, Y')); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="3" class="text-center">No Data</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <?php if(Auth::user()->roles->first()->name == EnumUserRole::MASTER->value): ?>
            <div class="row">
                <div class="col-lg-6">
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h4>Countries</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-visitor-countries"></div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-6">
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h4>Browsers</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-visitor-browsers"></div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-6">
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h4>Devices</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-visitor-devices"></div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-6">
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h4>Operating Systems</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-visitor-os"></div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<!-- Need: Apexcharts -->
<script src="<?php echo e(asset('assets/extensions/apexcharts/apexcharts.min.js')); ?>"></script>

<script>
    const labels = <?php echo json_encode($labels, 15, 512) ?> || [];
    const data = <?php echo json_encode($data, 15, 512) ?> || [];
    const colors = <?php echo json_encode($colors, 15, 512) ?> || [];

    const optionsPostView = {
        chart: { type: 'bar', height: 300 },
        series: [{ name: 'Views', data: data }],
        xaxis: { categories: labels },
        colors: colors
    };

    const historycalVisitorCountries = <?php echo json_encode($historycalVisitorCountries, 15, 512) ?> || {};
    const optionsVisitorCountries = {
        chart: { type: 'donut', width: '100%', height: '350px' },
        series: historycalVisitorCountries.series || [],
        labels: historycalVisitorCountries.labels || [],
        colors: historycalVisitorCountries.colors || [],
        legend: { position: 'bottom' },
        plotOptions: { pie: { donut: { size: '30%' } } }
    };

    const historycalVisitorBrowsers = <?php echo json_encode($historycalVisitorBrowsers, 15, 512) ?> || {};
    const optionsVisitorBrowsers = {
        chart: { type: 'donut', width: '100%', height: '350px' },
        series: historycalVisitorBrowsers.series || [],
        labels: historycalVisitorBrowsers.labels || [],
        colors: historycalVisitorBrowsers.colors || [],
        legend: { position: 'bottom' },
        plotOptions: { pie: { donut: { size: '30%' } } }
    };

    // New data for devices
    const historycalVisitorDevices = <?php echo json_encode($historycalVisitorDevices, 15, 512) ?> || {};
    const optionsVisitorDevices = {
        chart: { type: 'donut', width: '100%', height: '350px' },
        series: historycalVisitorDevices.series || [],
        labels: historycalVisitorDevices.labels || [],
        colors: historycalVisitorDevices.colors || [],
        legend: { position: 'bottom' },
        plotOptions: { pie: { donut: { size: '30%' } } }
    };

    // New data for operating systems
    const historycalVisitorOS = <?php echo json_encode($historycalVisitorOS, 15, 512) ?> || {};
    const optionsVisitorOS = {
        chart: { type: 'donut', width: '100%', height: '350px' },
        series: historycalVisitorOS.series || [],
        labels: historycalVisitorOS.labels || [],
        colors: historycalVisitorOS.colors || [],
        legend: { position: 'bottom' },
        plotOptions: { pie: { donut: { size: '30%' } } }
    };

    document.addEventListener('DOMContentLoaded', function () {
        const chartPostView = new ApexCharts(document.querySelector('#chart-post-view'), optionsPostView);
        const chartVisitorCountries = new ApexCharts(document.querySelector('#chart-visitor-countries'), optionsVisitorCountries);
        const chartVisitorBrowsers = new ApexCharts(document.querySelector('#chart-visitor-browsers'), optionsVisitorBrowsers);
        const chartVisitorDevices = new ApexCharts(document.querySelector('#chart-visitor-devices'), optionsVisitorDevices);
        const chartVisitorOS = new ApexCharts(document.querySelector('#chart-visitor-os'), optionsVisitorOS);
        
        chartPostView.render();
        chartVisitorCountries.render();
        chartVisitorBrowsers.render();
        chartVisitorDevices.render();
        chartVisitorOS.render();
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('template.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views\backend\dashboard\index.blade.php ENDPATH**/ ?>