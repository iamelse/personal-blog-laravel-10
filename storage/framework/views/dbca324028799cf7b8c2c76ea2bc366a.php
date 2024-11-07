<?php $__env->startSection('content'); ?>
    <div id="main-content">
        
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Edit Language Skill</h3>
                        <p class="text-subtitle text-muted">Update and modify your existing language skills information.</p>
                    </div>
                </div>
            </div>            
        </div>

        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="<?php echo e(route('skill.language.update', $languageSkill->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                            
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mandatory mb-3">
                                            <label class="form-label">Language Skill Name</label>
                                            <input type="text" class="form-control <?php $__errorArgs = ['language_skill_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Language Skill Name" name="language_skill_name" value="<?php echo e(old('language_skill_name', $languageSkill->name)); ?>" />
                                            <?php $__errorArgs = ['language_skill_name'];
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
                            
                                        <div class="form-group mandatory mb-3">
                                            <label class="form-label">Level</label>
                                            <select class="form-control <?php $__errorArgs = ['level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="level">
                                                <option value="" selected>Select level...</option>
                                                <option value="Beginner" <?php echo e(old('level', $languageSkill->level) == 'Beginner' ? 'selected' : ''); ?>>Beginner</option>
                                                <option value="Intermediate" <?php echo e(old('level', $languageSkill->level) == 'Intermediate' ? 'selected' : ''); ?>>Intermediate</option>
                                                <option value="Advanced" <?php echo e(old('level', $languageSkill->level) == 'Advanced' ? 'selected' : ''); ?>>Advanced</option>
                                            </select>
                                            <?php $__errorArgs = ['level'];
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
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-sm btn-primary me-1 mb-1">Submit</button>
                                        <a href="<?php echo e(route('skill.language.index')); ?>" class="btn btn-sm btn-light-secondary me-1 mb-1">Cancel</a>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
</script>
<script>
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    name.addEventListener('change', function() {
        fetch("<?php echo e(route('api.post.category.check.slug')); ?>?name=" + encodeURIComponent(name.value))
            .then(response => response.json())
            .then(data => slug.value = data.slug)
            .catch(error => console.error('Error:', error));
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('template.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views\backend\resume\skills\language\edit.blade.php ENDPATH**/ ?>