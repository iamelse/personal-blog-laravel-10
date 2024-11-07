<!DOCTYPE html>
<html lang="en">

   <?php echo $__env->make('partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

   <body>
      <script src="<?php echo e(asset('assets/static/js/initTheme.js')); ?>"></script>
      <div id="app">
        
        <?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

         <div id="main" class='layout-navbar navbar-fixed'>
            <header>
               
                <?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </header>
        
            <?php echo $__env->yieldContent('content'); ?>
            
            <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

         </div>
      </div>
      <script src="<?php echo e(asset('assets/static/js/components/dark.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/compiled/js/app.js')); ?>"></script>
      <?php echo $__env->yieldPushContent('scripts'); ?>
   </body>
</html><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views\template\main.blade.php ENDPATH**/ ?>