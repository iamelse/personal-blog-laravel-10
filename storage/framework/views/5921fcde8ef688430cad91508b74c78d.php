<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>

    <title><?php echo e($title ?? env('APP_NAME')); ?></title>
</head>

<body>
    <!-- Navbar -->
    <?php echo $__env->make('frontend.partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- End Navbar -->

    <!-- Main content -->
    <main>
        <div class="container">

            <div class="row">
                <!-- First col -->
                <div class="col-lg-12">

                    <article class="col-lg-12 pb-2">
                        <header>
                            <h1 class="text l-text-dark display-5 fw-bold">
                                <?php echo e($post->title); ?>

                            </h1>
                            <div class="d-flex align-items-center my-4">
                                <img src="<?php echo e(empty($post->author->image_profile) ? 'https://via.placeholder.com/150' : (Storage::disk('public_uploads')->exists($post->author->image_profile) ? asset('uploads/' . $post->author->image_profile) : 'https://via.placeholder.com/150')); ?>" alt="Profile Image" class="me-2 rounded-circle" style="width: 45px; height: 45px; object-fit: cover;">
                                <div class="post-metadata">
                                    <span class="author l-text-dark"><?php echo e($post->author->name); ?></span>
                                    <span class="category l-text-dark">in <?php echo e($post->category->name); ?></span>
                                    <div class="time">
                                        <?php
                                            $totalWords = str_word_count(strip_tags($post->body));
                                            $readingSpeed = 200;

                                            $estimatedTime = ceil($totalWords / $readingSpeed);
                                        ?>
                                        <small class="date l-text-p"><?php echo e($estimatedTime); ?> mins read</small>
                                        <small class="date l-text-p">.</small>
                                        <small class="date l-text-p"><?php echo e(\Carbon\Carbon::parse($post->created_at)->format('M d, Y')); ?></small>
                                    </div>
                                </div>
                                                                
                            </div>                                                      
                        </header>
                        <div class="content">
                            <?php echo $post->body; ?>

                        </div>
                    </article>                    
                </div>
                <!-- End first col -->

                <div class="my-3"></div>

                <!-- Second col -->
                <div class="col-lg-12">
                    <h5 class="text l-text-dark fw-bold my-3">Recommendations</h5>
                    <section class="col-lg-12 my-3">
                        <div class="row card-list">
                            <?php $__empty_1 = true; $__currentLoopData = $relatedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-lg-6">
                                <div class="card flex-row border-0">
                                    <img class="card-img-left l-card-img align-self-center" src="<?php echo e(getPostCoverImage($relatedPost)); ?>"/>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <span class="dash-date-list-card">—</span>
                                                <span class="date-list-card text-uppercase"><?php echo e(\Carbon\Carbon::parse($relatedPost->created_at)->format('M d, Y')); ?></span>
                                                <a href="<?php echo e(route('article.show', $relatedPost->slug)); ?>">
                                                    <h5 class="l-card-title h5 h4-sm mt-1 l-text-dark"><?php echo e($relatedPost->title); ?></h5>
                                                </a>
                                                <p class="l-card-text"><?php echo e(\Illuminate\Support\Str::limit(strip_tags($relatedPost->body), 100)); ?></p>
                                            </div>
                                            <a class="arrow-card-link mt-5 ms-4" href="<?php echo e(route('article.show', $relatedPost->slug)); ?>">
                                                <i class='bx bx-right-arrow-alt bx-sm align-self-center mt-2'></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <hr class="card-hr">
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col-lg-12 text-center">
                                <p class="l-card-text">No Data</p>
                            </div>
                            <?php endif; ?>
                        </div>        
                    </section>
                </div>
                <!-- End second col -->
            </div>

        </div>
    </main>
    <!-- End main content -->

    <footer>
        <div class="container mt-4">
          <hr class="card-hr">
          <div class="row py-4">
            <div class="col-md-6">
              <p class="text l-text-p l-card-text">Copyright © Iamelse. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end">
              <!-- Social Media Icons with Boxicons -->
              <ul class="list-inline">
                <li class="list-inline-item">
                  <a href="#" target="_blank" title="Facebook">
                    <i class='bx bxl-facebook l-text-p bx-sm text l-text-primary'></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#" target="_blank" title="Instagram">
                    <i class='bx bxl-instagram l-text-p bx-sm text l-text-primary'></i>
                  </a>
                </li>
                <!-- Add more social media icons as needed -->
              </ul>
            </div>
          </div>
        </div>
    </footer>

</body>


</html><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views\frontend\article\show.blade.php ENDPATH**/ ?>