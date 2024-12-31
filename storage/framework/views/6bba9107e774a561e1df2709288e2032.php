<?php $__env->startSection('content'); ?>
<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Posts</h3>
                    <p class="text-subtitle text-muted">View and manage all your posts.</p>
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
                                <div class="d-flex justify-content-end mb-4">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_posts', $posts)): ?>
                                        <a href="<?php echo e(route('post.create')); ?>" class="btn btn-primary btn-sm me-2">
                                            New Post
                                        </a>
                                    <?php endif; ?>
                            
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('mass_destroy_posts', $posts)): ?>
                                        <button type="submit" class="btn btn-danger btn-sm" id="deleteSelectedBtn" onclick="submitMassDestroy()" disabled>Delete Selected</button>
                                    <?php endif; ?>
                                </div>
                            </div>                            
                            <div class="row">
                                <div class="col-10 text-start">
                                    <div class="row">
                                        <div class="col-1">
                                            <form method="GET" action="<?php echo e(route('post.index')); ?>">
                                                <label for="limit" class="fw-bold">Limit:</label>
                                                <select name="limit" id="limit" class="form-select col-2" onchange="this.form.submit()">
                                                    <option value="10" <?php echo e(request('limit') == 10 ? 'selected' : ''); ?>>10</option>
                                                    <option value="25" <?php echo e(request('limit') == 25 ? 'selected' : ''); ?>>25</option>
                                                    <option value="50" <?php echo e(request('limit') == 50 ? 'selected' : ''); ?>>50</option>
                                                    <option value="100" <?php echo e(request('limit') == 100 ? 'selected' : ''); ?>>100</option>
                                                </select>
                                                <input type="hidden" name="category_id" value="<?php echo e(request('category_id')); ?>">
                                                <input type="hidden" name="q" value="<?php echo e(request('q')); ?>">
                                                <input type="hidden" name="page" value="<?php echo e(request('page')); ?>">
                                            </form>
                                        </div>
                                        <div class="col-2">
                                            <form method="GET" action="<?php echo e(route('post.index')); ?>">
                                                <label for="category_id" class="fw-bold">Category:</label>
                                                <select name="category_id" id="selectPostCategory" class="form-select col-2" onchange="this.form.submit()">
                                                    <option value="" <?php echo e(request('category_id') === null ? 'selected' : ''); ?>>All Categories</option>
                                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($category->id); ?>" <?php echo e(request('category_id') == $category->id ? 'selected' : ''); ?>>
                                                                <?php echo e($category->name); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <input type="hidden" name="limit" value="<?php echo e(request('limit')); ?>">
                                                <input type="hidden" name="q" value="<?php echo e(request('q')); ?>">
                                                <input type="hidden" name="page" value="<?php echo e(request('page')); ?>">
                                            </form>
                                        </div>
                                    </div>                                        
                                </div>
                                <div class="col-2">
                                    <form method="GET" action="<?php echo e(route('post.index')); ?>">
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
                                            <input type="hidden" name="limit" value="<?php echo e(request('limit')); ?>">
                                            <input type="hidden" name="category_id" value="<?php echo e(request('category_id')); ?>">
                                            <input type="hidden" name="page" value="<?php echo e(request('page')); ?>">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>                         
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <form id="massDestroyForm" method="POST" action="<?php echo e(route('post.mass.destroy')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                
                                <div class="table-responsive">
                                    <table class="table table-lg">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <input type="checkbox" class="form-check-input" id="selectAll">
                                                </th>
                                                <th>No.</th>
                                                <th>Cover</th>
                                                <th>Category</th>
                                                <th>Author</th>
                                                <th>Post Title</th>
                                                <th>Slug</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input" name="ids[]" value="<?php echo e($post->id); ?>">
                                                </td>
                                                <td class="text-bold-500"><?php echo e($loop->iteration); ?></td>
                                                <td>
                                                    <img src="<?php echo e(getPostCoverImage($post)); ?>" class="rounded-3" style="width: 100px; height: 100px; object-fit: cover;">
                                                </td>
                                                <td class="text-bold-500"><?php echo e($post->category->name ?? ''); ?></td>
                                                <td class="text-bold-500"><?php echo e($post?->author?->name); ?></td>
                                                <td class="text-bold-500"><?php echo e($post->title ?? ''); ?></td>
                                                <td class="text-bold-500"><?php echo e($post->slug ?? ''); ?></td>
                                                <?php
                                                    $status = $post->status;
                                                ?>

                                                <td class="text-bold-500">
                                                    <?php switch($status):
                                                        case (\App\Enums\PostStatus::DRAFT->value): ?>
                                                            <span class="badge rounded-pill bg-secondary">Draft</span>
                                                            <?php break; ?>

                                                        <?php case (\App\Enums\PostStatus::SCHEDULED->value): ?>
                                                            <span class="badge rounded-pill bg-warning text-dark">Scheduled</span>
                                                            <?php break; ?>

                                                        <?php case (\App\Enums\PostStatus::PUBLISHED->value): ?>
                                                            <span class="badge rounded-pill bg-success">Published</span>
                                                            <?php break; ?>

                                                        <?php default: ?>
                                                            <span class="badge rounded-pill bg-light text-dark">Unknown</span>
                                                    <?php endswitch; ?>
                                                </td>
                                                <td>
                                                    <div style="display: flex; gap: 5px;">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_posts', $post)): ?>
                                                        <a href="<?php echo e(route('post.edit', $post->id)); ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('destroy_posts', $post)): ?>
                                                        <form method="POST" action="<?php echo e(route('post.destroy', $post->id)); ?>">
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
                                                <td class="text-center" colspan="10">No Data</td>
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <!-- Pagination links -->
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <?php echo e($posts->appends(['category_id' => request('category_id'), 'limit' => request('limit'), 'q' => request('q')])->links()); ?>

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
<script>
    const selectAllCheckbox = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('input[name="ids[]"]');
    const deleteButton = document.getElementById('deleteSelectedBtn');

    // Toggle all checkboxes when "Select All" is clicked
    selectAllCheckbox.addEventListener('click', function() {
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        toggleDeleteButton(); // Manually call the function to update the button state
    });

    // Function to toggle the delete button
    function toggleDeleteButton() {
        const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        deleteButton.disabled = !anyChecked;
    }

    // Listen for individual checkbox changes
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', toggleDeleteButton);
    });

    // Initial state of the delete button
    toggleDeleteButton();

    // Mass delete logic
    function submitMassDestroy() {
        const selectedIds = Array.from(checkboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);

        console.log("Selected IDs:", selectedIds);

        if (selectedIds.length === 0) {
            alert("Please select at least one post to delete.");
            return;
        }

        if (confirm("Are you sure you want to delete the selected posts?")) {
            const form = document.getElementById('massDestroyForm');
            form.querySelectorAll('input[name="ids[]"]').forEach(input => input.remove());

            selectedIds.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = id;
                form.appendChild(input);
            });

            form.submit();
        }
    }
</script>
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
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $( '#selectPostCategory' ).select2( {
        theme: 'bootstrap-5',
    } );
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('template.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views/backend/article/index.blade.php ENDPATH**/ ?>