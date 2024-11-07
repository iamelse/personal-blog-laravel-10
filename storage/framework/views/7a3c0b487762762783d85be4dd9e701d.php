<!DOCTYPE html>
<html lang="en">

<?php echo $__env->make('frontend.partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body>

    <?php echo $__env->make('frontend.partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('frontend.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>


</html><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views/frontend/template/main.blade.php ENDPATH**/ ?>