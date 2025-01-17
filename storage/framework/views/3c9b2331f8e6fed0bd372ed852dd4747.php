<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <main>
        <div class="container">
            <!-- First row -->
            <div class="row">
                <!-- First col -->
                <div class="col-lg-8">
                    <section class="col-lg-12 pb-2">
                    
                        <?php if($home): ?>
                            <?php if($home->image): ?>
                                <div class="container mb-3">
                                    <img src="<?php echo e(getHomeImageProfile($home)); ?>" class="rounded-circle img-fluid" style="width: 75px; height: 75px; object-fit: cover;">
                                </div>
                            <?php elseif($home->url): ?>
                                <div class="container mb-3">
                                    <img src="<?php echo e($home->url); ?>" class="rounded-circle img-fluid" style="width: 75px; height: 75px; object-fit: cover;">
                                </div>
                            <?php endif; ?>
                            
                            <?php echo $home ? $home->body : '<p class="text text-center l-text-p">No Data</p>'; ?>

                        <?php else: ?>
                            
                        <?php endif; ?>
                    </section>
                </div>
                <!-- End first col -->
            </div>
            <!-- End first row -->

            <!-- Second row -->
            <div class="row">
                <!-- First col -->
                <div class="col-lg-8">
                    <?php if (! ($postCategories->isEmpty())): ?>
                        <section class="pb-2">
                            <h5 class="text l-text-dark fw-bold my-3">Latest Articles</h5>

                            <!-- Tab -->
                            <ul class="nav nav-underline">
                                <?php $__empty_1 = true; $__currentLoopData = $postCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo e($loop->first ? 'active' : ''); ?>" id="tab<?php echo e(ucfirst($category->slug)); ?>" data-bs-toggle="pill" href="#content<?php echo e(ucfirst($category->slug)); ?>">
                                            <?php echo e($category->name); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                <?php endif; ?>
                                <!--
                                <li class="nav-item">
                                    <a class="nav-link active" id="tabCoding" data-bs-toggle="pill" href="#contentCoding">Coding</a>
                                </li>
                                -->
                            </ul>
            
                            <div class="tab-content">
                                <?php $__empty_1 = true; $__currentLoopData = $postCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="tab-pane fade <?php echo e($loop->first ? 'show active' : ''); ?>" id="content<?php echo e(ucfirst($category->slug)); ?>">
                                        <div class="card-list">
                                            <?php $__empty_2 = true; $__currentLoopData = $category->posts->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                                <div class="card flex-row border-0">
                                                    <img class="card-img-left l-card-img align-self-center" src="<?php echo e(getPostCoverImage($post)); ?>" alt="<?php echo e($post->title); ?>" />
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
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                                <p class="l-text-p my-3 text-center">No posts available in this category.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    
                                <?php endif; ?>
                            </div>                            
                            <!-- End tab -->
        
                        </section>
                    <?php else: ?>
                        <p class="l-text-p text my-3 text-center">No data.</p>
                    <?php endif; ?>
                </div>
                <!-- End first col -->
                <!--
                <div class="col-lg-4">
                    <section class="my-3">
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
            </div>
            <!-- End second row -->
            
            <!-- Third row -->
            <div class="row">
                <div class="col-lg-8">
                    <section class="">
                        <h5 class="text l-text-dark fw-bold my-3">Open-Source Projects</h5>
                        <!-- Opens source projects -->
                        <div class="row">
                            <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 pb-3">
                                    <div class="card l-card-border-color px-3">
                                        <div class="card-body mt-2">
                                            <div class="circle-container l-card-border-color shadow-sm mb-2">
                                                <div class="circle-content">
                                                <i class='bx bxs-folder-open'></i>
                                                </div>
                                            </div>
                                            <h5 class="l-card-title l-text-dark"><?php echo e($project->title); ?></h5>
                                            <p class="l-card-text">
                                                <?php echo e(\Illuminate\Support\Str::limit(strip_tags($project->desc), 80)); ?>

                                            </p>
                                            <div class="row text-end">
                                                <a class="arrow-card-link" href="">
                                                    <i class='bx bx-right-arrow-alt bx-sm'></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <p class="text text-center l-text-p">No Data</p>
                            <?php endif; ?>
                        </div>
                        <!-- End opens source projects -->
                    </section>
                </div>
            </div>
            <!-- End third row -->
        </div>
    </main>
    <!-- End main content -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.template.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views\frontend\home\index.blade.php ENDPATH**/ ?>