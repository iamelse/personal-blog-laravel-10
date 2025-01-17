<?php $__env->startSection('content'); ?>
<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Log Activity</h3>
                    <p class="text-subtitle text-muted">View recent activities by users or system events.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Activity Log</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Log Activity Table start -->
        <section class="section">
            <div class="row" id="log-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form method="GET" action="<?php echo e(route('log.activity.index')); ?>" class="row align-items-end">
                                    <div class="col-md-4 mb-3">
                                        <label for="start_datetime" class="fw-bold">Start Datetime:</label>
                                        <input type="datetime-local" name="start_datetime" id="start_datetime" class="form-control" value="<?php echo e(request('start_datetime')); ?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="end_datetime" class="fw-bold">End Datetime:</label>
                                        <input type="datetime-local" name="end_datetime" id="end_datetime" class="form-control" value="<?php echo e(request('end_datetime')); ?>">
                                    </div>
                                    <div class="col-md-4 mb-3 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-2">Apply Filter</button>
                                        <a href="<?php echo e(route('log.activity.index')); ?>" class="btn btn-light">Clear Filter</a>
                                    </div>
                                    <input type="hidden" name="q" value="<?php echo e(request('q')); ?>">
                                    <input type="hidden" name="limit" value="<?php echo e(request('limit')); ?>">
                                    <input type="hidden" name="causer_id" value="<?php echo e(request('causer_id')); ?>">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>                                      
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-10 text-start">
                                        <div class="row">
                                            <div class="col-2">
                                                <form method="GET" action="<?php echo e(route('log.activity.index')); ?>">
                                                    <label for="limit" class="fw-bold">Limit:</label>
                                                    <select name="limit" id="limit" class="form-select" onchange="this.form.submit()">
                                                        <option value="10" <?php echo e(request('limit') == 10 ? 'selected' : ''); ?>>10</option>
                                                        <option value="25" <?php echo e(request('limit') == 25 ? 'selected' : ''); ?>>25</option>
                                                        <option value="50" <?php echo e(request('limit') == 50 ? 'selected' : ''); ?>>50</option>
                                                        <option value="100" <?php echo e(request('limit') == 100 ? 'selected' : ''); ?>>100</option>
                                                    </select>
                                                    <input type="hidden" name="q" value="<?php echo e(request('q')); ?>">
                                                    <input type="hidden" name="start_datetime" value="<?php echo e(request('start_datetime')); ?>">
                                                    <input type="hidden" name="end_datetime" value="<?php echo e(request('end_datetime')); ?>">
                                                    <input type="hidden" name="causer_id" value="<?php echo e(request('causer_id')); ?>">
                                                </form>
                                            </div>
                                            <div class="col-2">
                                                <form method="GET" action="<?php echo e(route('log.activity.index')); ?>">
                                                    <label for="causer_id" class="fw-bold">Causer:</label>
                                                    <select name="causer_id" id="selectPostcauser" class="form-select" onchange="this.form.submit()">
                                                        <option value="" <?php echo e(request('causer_id') === null ? 'selected' : ''); ?>>All Causer</option>
                                                        <?php $__currentLoopData = $causers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $causer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($causer->id); ?>" <?php echo e(request('causer_id') == $causer->id ? 'selected' : ''); ?>>
                                                                <?php echo e($causer->name); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <input type="hidden" name="q" value="<?php echo e(request('q')); ?>">
                                                    <input type="hidden" name="start_datetime" value="<?php echo e(request('start_datetime')); ?>">
                                                    <input type="hidden" name="end_datetime" value="<?php echo e(request('end_datetime')); ?>">
                                                </form>
                                            </div>
                                        </div>                                    
                                    </div>
                                    <div class="col-2">
                                        <form method="GET" action="<?php echo e(route('log.activity.index')); ?>">
                                            <div class="form-group mandatory">
                                                <label for="search" class="fw-bold">Search:</label>
                                                <input
                                                    type="text"
                                                    class="form-control <?php $__errorArgs = ['q'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    placeholder="Search"
                                                    name="q"
                                                    value="<?php echo e(request('q')); ?>"
                                                />
                                                <?php $__errorArgs = ['q'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($message); ?></strong>
                                                    </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                <input type="hidden" name="start_datetime" value="<?php echo e(request('start_datetime')); ?>">
                                                <input type="hidden" name="end_datetime" value="<?php echo e(request('end_datetime')); ?>">
                                                <input type="hidden" name="limit" value="<?php echo e(request('limit')); ?>">
                                                <input type="hidden" name="causer_id" value="<?php echo e(request('causer_id')); ?>">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Table with activity log -->
                                <div class="table-responsive">
                                    <table class="table table-lg">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Description</th>
                                                <th>Causer</th>
                                                <th>Timestamp</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="text-bold-500"><?php echo e(($activities->currentPage() - 1) * $activities->perPage() + $index + 1); ?></td>
                                                <td><?php echo e($activity->description ?? 'No description available'); ?></td>
                                                <td><?php echo e($activity->causer->name ?? 'Unknown/Anonymous'); ?></td>
                                                <td><?php echo e($activity->created_at ? $activity->created_at->format('F j, Y, g:i A') : 'Unknown time'); ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>

                                    <?php if($activities->isEmpty()): ?>
                                        <p class="text-center">No activity logs available.</p>
                                    <?php endif; ?>
                                </div>

                                <!-- Pagination links -->
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <?php echo e($activities->appends(request()->query())->links()); ?>

                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Log Activity Table end -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views\backend\log_activity\index.blade.php ENDPATH**/ ?>