<?php $__env->startSection('content'); ?>
    <div id="auth">
        <div class="row h-100">
            <!-- Left Column -->
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="<?php echo e(url()->current()); ?>"><img src="<?php echo e(asset('assets/static/images/logo/logo.svg')); ?>" alt="Logo"></a>
                    </div>
                    <h1 class="display-6 fw-bold">Log in.</h1>
                    <p class="fs-5 text-gray-500 mb-5">Log in with your data that you entered during registration.</p>

                    <form action="<?php echo e(route('authenticate')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <!-- Email Field -->
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input 
                                type="text" 
                                name="email" 
                                class="form-control form-control-lg <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                placeholder="Email" 
                                value="<?php echo e(old('email')); ?>">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            <!-- Error Message -->
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-danger fw-bold mt-1" style="font-size: 0.85rem;">
                                    * <?php echo e($message); ?>

                                </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    
                        <!-- Password Field -->
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input 
                                type="password" 
                                name="password" 
                                class="form-control form-control-lg <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <!-- Error Message -->
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-danger fw-bold mt-1" style="font-size: 0.85rem;">
                                    * <?php echo e($message); ?>

                                </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary btn-block btn-md shadow-md mt-3 py-2">
                            Log in
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Column (Empty) -->
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views/auth/login.blade.php ENDPATH**/ ?>