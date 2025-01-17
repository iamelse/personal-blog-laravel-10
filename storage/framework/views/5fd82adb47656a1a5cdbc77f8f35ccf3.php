<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <main>
        <div class="container">

            <div class="row">
                <!-- First col -->
                <div class="col-lg-8">
                    <section class="col-lg-12 pb-2">
                        <?php if($about): ?>
                            <?php echo $about->body; ?>

                        <?php else: ?>
                            <p class="text text-center l-text-p">No Data</p>
                        <?php endif; ?>
                    </section>                    
                </div>
                <!-- End first col -->

                <!-- Second col -->
                <!--
                <div class="col-lg-4">
                    <section class="col-lg-12 my-3">
                        <div class="card l-card-border-color px-3">
                            <div class="card-body text-center">
                                <h5 class="l-card-title l-text-dark">Never miss an update!</h5>
                                <p class="l-card-text">Subscribe and join 100K+ developers.</p>
    
                                <form class="mb-3">
                                    <div class="l-form mb-3 mt-4">
                                        <input type="text" class="form-control" placeholder="Your email...">
                                    </div>
                                    <button class="btn l-btn-primary w-100">Subscribe</button>
                                </form>
                                
                            </div>
                        </div>                  
                    </section>
                </div>
                -->
                <!-- End second col -->
            </div>

        </div>
    </main>
    <!-- End main content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.template.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views/frontend/about/index.blade.php ENDPATH**/ ?>