<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Hide archive posts from search engines -->
    <meta name="robots" content="<?php echo e($post->status === \App\Enums\PostStatus::PUBLISHED->value ? 'index, follow' : 'noindex, nofollow'); ?>">

    <!-- Dynamic Meta Tags -->
    <meta name="title" content="<?php echo e($post->seo && $post->seo->seo_title ? $post->seo->seo_title : $post->title); ?>">
    <meta name="description" content="<?php echo e($post->seo && $post->seo->seo_description ? $post->seo->seo_description : Str::limit(strip_tags($post->body), 150)); ?>">
    <meta name="keywords" content="<?php echo e($post->seo && $post->seo->seo_keywords ? Str::of($post->seo->seo_keywords)->lower()->replaceMatches('/\s*,\s*/', ',')->trim(',')->title() : ''); ?>">
    <meta name="author" content="<?php echo e($post->author ? $post->author->name : ''); ?>">
    <meta name="category" content="<?php echo e($post->category ? $post->category->name : ''); ?>">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo e($post->seo && $post->seo->seo_title ? $post->seo->seo_title : $post->title); ?>">
    <meta property="og:description" content="<?php echo e($post->seo && $post->seo->seo_description ? $post->seo->seo_description : Str::limit(strip_tags($post->body), 150)); ?>">
    <meta property="og:image" content="<?php echo e(getPostCoverImage($post)); ?>">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:type" content="article">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($post->seo && $post->seo->seo_title ? $post->seo->seo_title : $post->title); ?>">
    <meta name="twitter:description" content="<?php echo e($post->seo && $post->seo->seo_description ? $post->seo->seo_description : Str::limit(strip_tags($post->body), 150)); ?>">
    <meta name="twitter:image" content="<?php echo e(getPostCoverImage($post)); ?>">

    <link rel="icon" href="<?php echo e(asset('assets/favicon.png')); ?>" type="image/png">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' media="print" onload="this.media='all'">

    <!-- Font Awesome CSS loaded asynchronously -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" as="style">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="print" onload="this.media='all'">

    <!-- Your custom app.css loaded asynchronously -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/export-vite/css/app.css')); ?>" media="print" onload="this.media='all'">

    <!-- Defer non-critical JS (app2.js) to avoid blocking rendering -->
    <script src="<?php echo e(asset('assets/export-vite/js/app2.js')); ?>" defer></script>

    <!-- Dynamic Title -->
    <title><?php echo e($post->title ?? $title ?? env('APP_NAME')); ?></title>
</head>

<body class="loading">

    <!-- Loader -->
    <div class="loader" id="loader"></div>

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

    <!-- Footer -->
    <?php echo $__env->make('frontend.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- End Footer -->

    <script>
        window.addEventListener('load', function () {
            setTimeout(function () {
                document.body.classList.remove('loading');
                document.body.classList.add('loaded');
            }, 2000);
        });
    </script>

    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            
            if (window.scrollY > 10) {
                navbar.classList.add('shadow-sm');
            } else {
                navbar.classList.remove('shadow-sm');
            }
        });
    </script>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "BlogPosting",
            "headline": "<?php echo e($post->title); ?>",
            "image": "<?php echo e(getPostCoverImage($post)); ?>",
            "author": {
                "@type": "Person",
                "name": "<?php echo e($post->author->name); ?>"
            },
            "datePublished": "<?php echo e($post->created_at->toIso8601String()); ?>",
            "dateModified": "<?php echo e($post->updated_at->toIso8601String()); ?>",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "<?php echo e(url()->current()); ?>"
            },
            "description": "<?php echo e(Str::limit(strip_tags($post->body), 150)); ?>"
        }
    </script>
    
</body>


</html><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views/frontend/article/show.blade.php ENDPATH**/ ?>