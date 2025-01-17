<?php $__env->startSection('content'); ?>
<div id="main-content">
    <div class="page-heading"> 
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Roles</h3>
                    <p class="text-subtitle text-muted">View and manage user roles.</p>
                </div>
            </div>
        </div>        
    </div>

    <!-- Basic Tables start -->
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-10 text-start">
                                    <div class="col-1">
                                        <form method="GET" action="<?php echo e(route('role.index')); ?>">
                                            <label for="limit" class="fw-bold">Limit:</label>
                                            <select name="limit" class="form-select col-2" onchange="this.form.submit()">
                                                <option value="10" <?php echo e(request('limit') == 10 ? 'selected' : ''); ?>>10</option>
                                                <option value="25" <?php echo e(request('limit') == 25 ? 'selected' : ''); ?>>25</option>
                                                <option value="50" <?php echo e(request('limit') == 50 ? 'selected' : ''); ?>>50</option>
                                                <option value="100" <?php echo e(request('limit') == 100 ? 'selected' : ''); ?>>100</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <form method="GET" action="<?php echo e(route('role.search')); ?>">
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
                                        </div>
                                    </form>
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
                                            <th>Role Name</th>
                                            <th>Total Permission</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="text-bold-500"><?php echo e($loop->iteration); ?></td>
                                            <td class="text-bold-500"><?php echo e($role->name); ?></td>
                                            <td class="text-bold-500"><?php echo e($role->permissions->count()); ?></td>
                                            <td>
                                                <a href="<?php echo e(route('role.show', $role->id)); ?>" class="btn btn-sm btn-outline-primary">Detail</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td class="text-center" colspan="4">No Data</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination links -->
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <?php echo e($roles->appends(['limit' => $perPage, 'q' => $q])->links()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>        
    <!-- Basic Tables end -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views\backend\role\index.blade.php ENDPATH**/ ?>