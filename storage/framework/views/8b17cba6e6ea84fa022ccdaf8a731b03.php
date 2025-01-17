<?php $__env->startSection('content'); ?>
<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Post Categories</h3>
                    <p class="text-subtitle text-muted">View and manage your post categories.</p>
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
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_post_categories', $postCategories)): ?>
                            <div class="row mb-4">
                                <div class="col-6"></div>
                                <div class="col-6 text-end">
                                    <a href="<?php echo e(route('post.category.create')); ?>" class="btn btn-primary btn-sm">
                                        New Category
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-10 text-start">
                                    <div class="col-1">
                                        <form method="GET" action="<?php echo e(route('post.category.index')); ?>">
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
                                    <form method="GET" action="<?php echo e(route('post.category.search')); ?>">
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
                                            <th>Post Category Name</th>
                                            <th>Slug</th>
                                            <?php if(auth()->user()->roles[0]->name === "Master"): ?>
                                                <th>Display on Homepage</th>
                                            <?php endif; ?>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $postCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="text-bold-500"><?php echo e($loop->iteration); ?></td>
                                            <td class="text-bold-500"><?php echo e($postCategory->name); ?></td>
                                            <td class="text-bold-500"><?php echo e($postCategory->slug); ?></td>
                                            <?php if(auth()->user()->roles[0]->name === "Master"): ?>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="true" name="isChecked_<?php echo e($postCategory->id); ?>" id="showInHomepageCheckbox_<?php echo e($postCategory->id); ?>" data-category-id="<?php echo e($postCategory->id); ?>" <?php echo e($postCategory->show_in_homepage ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="showInHomepageCheckbox_<?php echo e($postCategory->id); ?>">
                                                        Display on Homepage
                                                    </label>
                                                </div>
                                            </td>
                                            <?php endif; ?>                                                                                                
                                            <td>
                                                <div style="display: flex; gap: 5px;">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_post_categories', $postCategory)): ?>
                                                    <a href="<?php echo e(route('post.category.edit', $postCategory->id)); ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('destroy_post_categories', $postCategory)): ?>
                                                    <form method="POST" action="<?php echo e(route('post.category.destroy', $postCategory->id)); ?>">
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
                                            <td class="text-center" colspan="4">No Data</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination links -->
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <?php echo e($postCategories->appends(['limit' => request('limit'), 'q' => request('q')])->links()); ?>

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
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        function enforceConstraints() {
            var checkedCount = $('.form-check-input:checked').length;

            $('.form-check-input').each(function() {
                var isChecked = $(this).is(':checked');
                $(this).prop('disabled', checkedCount >= 4 && !isChecked || checkedCount === 1 && isChecked);
            });
        }

        $('.form-check-input').change(function(){
            var categoryId = $(this).data('category-id');
            var isChecked = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: '<?php echo e(route("api.post.category.updateVisibility")); ?>',
                type: 'PUT',
                data: {
                    categoryId: categoryId,
                    isChecked: isChecked
                },
                success: function(){
                    console.log('Visibility updated successfully');
                },
                error: function(xhr, status, error){
                    console.error('Error updating visibility:', error);
                }
            });

            enforceConstraints();
        });

        enforceConstraints();
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('template.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views/backend/post_category/index.blade.php ENDPATH**/ ?>