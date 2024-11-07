<?php $__env->startSection('content'); ?>
<div id="main-content">
    <div class="page-heading">
        
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Dashboard</h3>
                    <p class="text-subtitle text-muted">Navbar will appear on the top of the page.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Layout Vertical Navbar</li>
                    </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6"></div>
                                    <div class="col-6 text-end">
                                        <a href="<?php echo e(route('permission.create')); ?>" class="btn btn-primary btn-sm">
                                            New Permission
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Table with outer spacing -->
                                <div class="table-responsive">
                                    <table class="table table-lg">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Permission Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td class="text-bold-500"><?php echo e($loop->iteration); ?></td>
                                                <td class="text-bold-500"><?php echo e($permission->name); ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td class="text-center" colspan="3">No Data</td>
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Tables end -->

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views\backend\permission\index.blade.php ENDPATH**/ ?>