<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <main>
        <div class="container">

            <div class="row">
                <!-- First col -->
                <div class="col-lg-8">

                    <section class="col-lg-12 pb-2">
                        <h1 class="text l-text-dark display-5 fw-bold">
                            My latest update
                        </h1>
                    </section>

                    <section class="col-lg-12 pb-2">
    
                        <p class="l-text-p pb-3">
                            This newsletter is written by Mark Ivings, 
                            who previously worked at Google, Medium, Vimeo, 
                            and Qonto. Here is what to expect by subscribing:
                        </p>

                        <?php $__empty_1 = true; $__currentLoopData = $postCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $isActive = request()->query('category') == $postCategory->slug;
                            ?>
                            <form action="<?php echo e(route('article.search')); ?>" method="GET" class="d-inline">
                                <input type="hidden" name="category" value="<?php echo e($postCategory->slug); ?>">
                                <input type="hidden" name="query" value="<?php echo e(request()->query('query')); ?>">
                                <button type="submit" class="btn btn-sm my-1 <?php echo e($isActive ? 'btn-primary' : 'btn-outline-primary'); ?> fw-bold">
                                    <?php echo e($postCategory->name); ?>

                                </button>
                            </form>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <p class="l-card-text">
                                        No Post Categories Available
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="card-list mt-3">
                            <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="card flex-row border-0">
                                <img class="card-img-left l-card-img align-self-center" src="<?php echo e(getPostCoverImage($post)); ?>"/>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <span class="dash-date-list-card">—</span>
                                            <span class="date-list-card text-uppercase"><?php echo e(\Carbon\Carbon::parse($post->created_at)->format('M d, Y')); ?></span>
                                            <a href="<?php echo e(route('article.show', $post->slug)); ?>">
                                                <h5 class="l-card-title h5 h4-sm mt-1 l-text-dark"><?php echo e($post->title); ?></h5>
                                            </a>
                                            <p class="l-card-text"><?php echo e(\Illuminate\Support\Str::limit(strip_tags($post->body), 170)); ?></p>
                                        </div>
                                        <a class="arrow-card-link mt-5 ms-4" href="<?php echo e(route('article.show', $post->slug)); ?>">
                                            <i class='bx bx-right-arrow-alt bx-sm align-self-center mt-2'></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr class="card-hr">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <p class="l-card-text">
                                        No Post Available
                                    </p>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <!-- Pagination links -->
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <?php echo e($posts->links()); ?>

                            </div>
                        </div>
    
                    </section>

                </div>
                <!-- End first col -->

                <!-- Second col -->
                <!--
                <div class="col-lg-4">
                    <section class="my-3">
                        <div class="card l-card-border-color px-3">
                            <div class="card-body">
                                <h5 class="l-card-title l-text-dark text-center">Filter</h5>
                                <h6 class="l-text-dark fw-bold fs-6">Category</h6>
                                <h6 class="l-text-dark fw-bold fs-6">Author</h6>
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
<?php echo $__env->make('frontend.template.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views\frontend\article\index.blade.php ENDPATH**/ ?>