<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <h3>Home</h3>
                <p class="text-subtitle text-muted">Manage and update the content of your Home page here.</p>
            </div>
        </div>        

        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" action="<?php echo e(route('backend.home.update.image')); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
            
                                <div class="row">
                                    <!-- Image Preview -->
                                    <div class="col-md-2 d-flex justify-content-center align-items-center mb-3">
                                        <img id="imagePreview" 
                                             src="<?php echo e(getHomeImageProfile($home)); ?>" 
                                             class="img-fluid rounded-circle img-thumbnail" 
                                             style="width: 100px; height: 100px; object-fit: cover;">
                                    </div>
            
                                    <!-- Form Inputs -->
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="imageInput" class="form-label">Upload Image</label>
                                            <input type="file" class="form-control <?php $__errorArgs = ['imageInput'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                   name="imageInput" id="imageInput">
                                            <?php $__errorArgs = ['imageInput'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
            
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update_image_home', $home)): ?>
                                            <div class="d-flex justify-content-end mt-3">
                                                <button type="submit" class="btn btn-sm btn-primary me-1">Update</button>
                                                <a href="<?php echo e(route('backend.home.index')); ?>" class="btn btn-sm btn-light-secondary">Cancel</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>            

            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" action="<?php echo e(route('backend.home.update')); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>

                                <div class="form-group mandatory mb-3">
                                    <label class="form-label">Content</label>
                                    <textarea id="editor" class="form-control <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="content" rows="10" cols="50"><?php echo e(old('content', $home->body ?? '')); ?></textarea>
                                    <?php $__errorArgs = ['content'];
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
                            
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update_home', $home)): ?>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-sm btn-primary me-1 mb-1">Update</button>
                                        <a href="<?php echo e(route('backend.home.index')); ?>" class="btn btn-sm btn-light-secondary me-1 mb-1">Cancel</a>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </form>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        let reader = new FileReader();
        reader.onload = function() {
            let preview = document.getElementById('imagePreview');

            preview.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>
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
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
        clipboard_handleImages: false
    };
</script>
<script>
    var options = {
        colorButton_colors: '0ea5e9',
    };

    CKEDITOR.config.toolbar = [
        ['Source','Styles', 'Format', 'FontSize', 'TextColor'],
        ['Bold', 'Italic', 'Underline', 'StrikeThrough'],
        ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
    ];

    CKEDITOR.replace('editor', options);
    CKEDITOR.instances.editor.on('instanceReady', function (event) {
        this.dataProcessor.htmlFilter.addRules({
            elements: {
                p: function (el) {
                    el.addClass('l-text-p pb-2 fs-5');
                },
                h1: function (el) {
                    el.addClass('text l-text-dark fw-bold pb-2 display-5');
                },
                h2: headingClass,
                h3: headingClass,
                h4: headingClass,
                h5: headingClass,
                h6: headingClass
            }
        });
    });

    function headingClass(el) {
        el.addClass('text l-text-dark fw-bold my-3');
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('template.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views/backend/home/index.blade.php ENDPATH**/ ?>