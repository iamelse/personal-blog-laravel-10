<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <main>
        <div class="container">
    
            <div class="row">
                <!-- First col -->
                <div class="col-lg-8">
    
                    <section class="col-lg-12 pb-2">
                        <h1 class="text l-text-dark display-5 fw-bold">
                            My Resume
                        </h1>
                    </section>

                    <section class="col-lg-12 pb-2">
                    
                        <h5 class="text l-text-dark fw-bold my-3">Experience</h5>
    
                        <?php $__empty_1 = true; $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="row mb-2">
                                <div class="col-1">
                                    <div class="l-circle-container l-card-border-color shadow-sm mb-2">
                                        <div class="l-circle-content">
                                            <img style="width: <?php echo e($experience->company_logo_size); ?>rem;" src="<?php echo e(asset('/' . $experience->company_logo)); ?>" alt="">
                                            <!-- <i class='bx bxs-folder-open'></i> -->
                                        </div>
                                    </div>
                                </div>
        
                                <div class="col ps-4">
                                    <span class="date-list-card text-uppercase">
                                        <?php echo e(\Carbon\Carbon::parse($experience->start_date)->format('M d, Y')); ?>

                                        . 
                                        <?php echo e($experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('M d, Y') : 'PRESENT'); ?>

                                    </span>
                                    <h6 class="l-text-dark fw-bold mt-2"><?php echo e($experience->position_name); ?></h6>
                                    <h6 class="l-text-dark"><?php echo e($experience->company_name); ?></h6>
                                    <p class="l-card-text">
                                        <?php echo e($experience->desc); ?>

                                    </p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="l-card-text text-center">
                                No Data
                            </p>
                        <?php endif; ?>
    
                    </section>
    
                    <section class="col-lg-12 pb-2">
                    
                        <h5 class="text l-text-dark fw-bold my-3">Education</h5>

                        <?php $__empty_1 = true; $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="row mb-2">
                                <div class="col-1">
                                    <div class="l-circle-container l-card-border-color shadow-sm mb-2">
                                        <div class="l-circle-content">
                                            <img style="width: <?php echo e($education->school_logo_size); ?>rem;" src="<?php echo e(asset('/' . $education->school_logo)); ?>" alt="">
                                            <!-- <i class='bx bxs-folder-open'></i> -->
                                        </div>
                                    </div>
                                </div>
        
                                <div class="col ps-4">
                                    <span class="date-list-card text-uppercase">
                                        <?php echo e(\Carbon\Carbon::parse($education->start_date)->format('M d, Y')); ?>

                                        . 
                                        <?php echo e($education->end_date ? \Carbon\Carbon::parse($education->end_date)->format('M d, Y') : 'PRESENT'); ?>

                                    </span>
                                    <h6 class="l-text-dark fw-bold mt-2"><?php echo e($education->degree); ?>, <?php echo e($education->major); ?></h6>
                                    <h6 class="l-text-dark"><?php echo e($education->school_name); ?></h6>
                                    <p class="l-card-text">
                                        <?php echo e($education->desc); ?>

                                    </p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="l-card-text text-center">
                                No Data
                            </p>
                        <?php endif; ?>
    
                    </section>
    
                </div>
                <!-- End first col -->
    
                <!-- Second col -->
                <div class="col-lg-4">
                    <section class="col-lg-12 mt-3 mb-4">
                        <div class="card l-card-border-color px-3">
                            <div class="card-body">
                                <h5 class="l-card-title l-text-dark">Technical Skills</h5>
                                <div class="mt-3"></div>
                                <?php $__empty_1 = true; $__currentLoopData = $technicalSkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $technicalSkill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="row">
                                        <div class="col text-start">
                                            <p class="l-text-dark fw-bold">
                                                <span class="dash-date-list-card">
                                                    —
                                                    &nbsp;
                                                </span>
                                                <?php echo e($technicalSkill->name); ?>

                                            </p>
                                        </div>
                                        <div class="col text-end">
                                            <p class="l-card-text"><?php echo e($technicalSkill->level); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p class="l-card-text text-center">
                                        No Data
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>                  
                    </section>
    
                    <section class="col-lg-12 mb-4">
                        <div class="card l-card-border-color px-3">
                            <div class="card-body">
                                <h5 class="l-card-title l-text-dark">Language</h5>
                                <div class="mt-3"></div>
                                <?php $__empty_1 = true; $__currentLoopData = $languageSkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languageSkill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="row">
                                        <div class="col text-start">
                                            <p class="l-text-dark fw-bold">
                                                <span class="dash-date-list-card">
                                                    —
                                                    &nbsp;
                                                </span>
                                                <?php echo e($languageSkill->name); ?>

                                            </p>
                                        </div>
                                        <div class="col text-end">
                                            <p class="l-card-text"><?php echo e($languageSkill->level); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p class="l-card-text text-center">
                                        No Data
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>                  
                    </section>
                </div>
                <!-- End second col -->
            </div>
    
        </div>
    </main>
    <!-- End main content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.template.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views/frontend/resume/index.blade.php ENDPATH**/ ?>