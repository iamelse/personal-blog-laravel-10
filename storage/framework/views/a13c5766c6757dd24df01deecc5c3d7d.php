<?php $__env->startSection('content'); ?>
<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Project</h3>
                    <p class="text-subtitle text-muted">View and manage your current projects and tasks.</p>
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
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_projects', $projects)): ?>
                            <div class="row mb-4">
                                <div class="col-6"></div>
                                <div class="col-6 text-end">
                                    <a href="<?php echo e(route('backend.project.create')); ?>" class="btn btn-primary btn-sm">
                                        New Project
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-10 text-start">
                                    <div class="row">
                                        <div class="col-1">
                                            <form method="GET" action="<?php echo e(route('backend.project.index')); ?>">
                                                <label for="limit" class="fw-bold">Limit:</label>
                                                <select name="limit" id="limit" class="form-select col-2" onchange="this.form.submit()">
                                                    <option value="10" <?php echo e(request('limit') == 10 ? 'selected' : ''); ?>>10</option>
                                                    <option value="25" <?php echo e(request('limit') == 25 ? 'selected' : ''); ?>>25</option>
                                                    <option value="50" <?php echo e(request('limit') == 50 ? 'selected' : ''); ?>>50</option>
                                                    <option value="100" <?php echo e(request('limit') == 100 ? 'selected' : ''); ?>>100</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>                                        
                                </div>
                                <div class="col-2">
                                    <form method="GET" action="<?php echo e(route('backend.project.search')); ?>">
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
                                            <th>Project Title</th>
                                            <th>Slug</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="text-bold-500"><?php echo e($loop->iteration); ?></td>
                                            <td class="text-bold-500"><?php echo e($project->title ?? ''); ?></td>
                                            <td class="text-bold-500"><?php echo e($project->slug ?? ''); ?></td>
                                            <td>
                                                <div style="display: flex; gap: 5px;">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_projects', $projects)): ?>
                                                    <a href="<?php echo e(route('backend.project.edit', $project->id)); ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('destroy_projects', $projects)): ?>
                                                    <form method="POST" action="<?php echo e(route('backend.project.destroy', $project->id)); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" id="delete-btn">Delete</button>
                                                    </form>
                                                    <?php endif; ?>
                                                </div>
                                            </td>                                                
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td class="text-center" colspan="6">No Data</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination links -->
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <?php echo e($projects->appends(['limit' => $perPage, 'q' => $q])->links()); ?>

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

<?php $__env->startPush('scripts'); ?>
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
        const deleteButtons = document.querySelectorAll('#delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const form = this.closest('form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        confirmButton: 'btn btn-primary mx-1',
                        cancelButton: 'btn btn-danger mx-1'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        <?php if($errors->any()): ?>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Oops, something went wrong.',
                showConfirmButton: false,
                timer: 3000
            });
        <?php endif; ?>

        <?php if(session('success')): ?>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '<?php echo e(session('success')); ?>',
                showConfirmButton: false,
                timer: 3000
            });
        <?php endif; ?>
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $( '#selectPostCategory' ).select2( {
        theme: 'bootstrap-5',
    } );
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('template.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views\backend\project\index.blade.php ENDPATH**/ ?>