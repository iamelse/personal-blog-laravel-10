<?php $__env->startSection('content'); ?>
<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Role Details</h3>
                    <p class="text-subtitle text-muted">View the details of this user role.</p>
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
                            <h5><?php echo e($role->name); ?> Permissions</h5>
                        </div>
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" action="<?php echo e(route('role.store.permissions', $role->id)); ?>">
                                <?php echo csrf_field(); ?>
                                
                                <div class="row my-5">
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll">
                                            <label class="form-check-label" for="checkAll">Check All</label>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <?php
                                            $groupedPermissions = [];
                                    
                                            function humanReadablePermission($permissionName) {
                                                return ucwords(str_replace('_', ' ', $permissionName));
                                            }
                                    
                                            foreach ($permissions as $permission) {
                                                $parts = explode('_', $permission->name);
                                                $groupName = end($parts);
                                                if (!isset($groupedPermissions[$groupName])) {
                                                    $groupedPermissions[$groupName] = [];
                                                }
                                                $groupedPermissions[$groupName][] = $permission;
                                            }
                                        ?>
                                    
                                        <?php $__currentLoopData = $groupedPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupName => $groupPermissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input group-check" type="checkbox" id="checkGroup<?php echo e($loop->iteration); ?>" data-group="<?php echo e($groupName); ?>">
                                                        <label class="form-check-label" for="checkGroup<?php echo e($loop->iteration); ?>"><?php echo e(humanReadablePermission($groupName)); ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php $__currentLoopData = $groupPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="form-check">
                                                            <input class="form-check-input permission-check" name="permissions[]" value="<?php echo e($permission->id); ?>" data-group="<?php echo e($groupName); ?>" <?php echo e($role->hasPermissionTo($permission->name) ? 'checked' : ''); ?> type="checkbox" id="checkPermission<?php echo e($loop->parent->iteration); ?>_<?php echo e($loop->iteration); ?>">
                                                            <label class="form-check-label" for="checkPermission<?php echo e($loop->parent->iteration); ?>_<?php echo e($loop->iteration); ?>"><?php echo e(humanReadablePermission($permission->name)); ?></label>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                            <div class="my-4"></div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>                                    
                                </div>                                                                                         
                        
                                <div class="mt-3 text-end">
                                    <button type="submit" class="btn btn-sm btn-primary">Save Permissions</button>
                                </div>
                            </form>
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
        <?php if($errors->any()): ?>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'There are errors in the form!',
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkAll = document.getElementById('checkAll');
        const groupCheckboxes = document.querySelectorAll('.group-check');
        const permissionCheckboxes = document.querySelectorAll('.permission-check');

        function updateGroupCheckbox(groupName) {
            const groupPermissions = document.querySelectorAll(`.permission-check[data-group="${groupName}"]`);
            const allChecked = Array.from(groupPermissions).every(checkbox => checkbox.checked);
            document.querySelector(`.group-check[data-group="${groupName}"]`).checked = allChecked;
        }

        function updateCheckAll() {
            const allChecked = Array.from(permissionCheckboxes).every(checkbox => checkbox.checked);
            checkAll.checked = allChecked;
        }

        checkAll.addEventListener('change', function() {
            groupCheckboxes.forEach(function(groupCheckbox) {
                groupCheckbox.checked = checkAll.checked;
            });

            permissionCheckboxes.forEach(function(checkbox) {
                checkbox.checked = checkAll.checked;
            });
        });

        groupCheckboxes.forEach(function(groupCheckbox) {
            groupCheckbox.addEventListener('change', function() {
                const groupName = groupCheckbox.dataset.group;
                const groupPermissions = document.querySelectorAll(`.permission-check[data-group="${groupName}"]`);
                groupPermissions.forEach(function(permission) {
                    permission.checked = groupCheckbox.checked;
                });
                updateCheckAll();
            });
        });

        permissionCheckboxes.forEach(function(permissionCheckbox) {
            permissionCheckbox.addEventListener('change', function() {
                const groupName = permissionCheckbox.dataset.group;
                updateGroupCheckbox(groupName);
                updateCheckAll();
            });
        });

        groupCheckboxes.forEach(function(groupCheckbox) {
            const groupName = groupCheckbox.dataset.group;
            updateGroupCheckbox(groupName);
        });
        updateCheckAll();
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('template.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views/backend/role/show.blade.php ENDPATH**/ ?>