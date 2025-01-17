<footer>
    <div class="container mt-4">
      <hr class="card-hr">
      <div class="row py-4">
        <div class="col-md-6">
          <p class="text-center text-lg-start text-md-start l-text-p l-card-text">Copyright © Iamelse. All rights reserved.</p>
        </div>
        <div class="col-md-6 text-center text-lg-end text-md-end">
          <!-- Social Media Icons with Boxicons -->
          <ul class="list-inline">
          <?php $__empty_1 = true; $__currentLoopData = $socialMedias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialMedia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <li class="list-inline-item">
              <a href="<?php echo e($socialMedia->url); ?>" target="_blank" title="<?php echo e($socialMedia->name); ?>">
                <i class='<?php echo strtolower($socialMedia->icon); ?> l-text-p bx-sm text l-text-primary'></i>
              </a>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              
          <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
</footer><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views/frontend/partials/footer.blade.php ENDPATH**/ ?>