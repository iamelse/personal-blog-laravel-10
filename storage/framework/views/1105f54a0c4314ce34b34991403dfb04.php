<!-- Navbar -->
<nav class="navbar fixed-top py-3 navbar-expand-lg bg-white">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item me-1">
                    <a class="nav-link <?php echo e(request()->is('/') ? 'active' : ''); ?>" href="<?php echo e(route('home.index')); ?>">Home</a>
                </li>
            
                <li class="nav-item me-1">
                    <a class="nav-link <?php echo e(request()->is('about*') ? 'active' : ''); ?>" href="<?php echo e(route('about.index')); ?>">About</a>
                </li>
            
                <li class="nav-item me-1">
                    <a class="nav-link <?php echo e(request()->is('project*') ? 'active' : ''); ?>" href="<?php echo e(route('project.index')); ?>">Projects</a>
                </li>
            
                <li class="nav-item me-1">
                    <a class="nav-link <?php echo e(request()->is('resume*') ? 'active' : ''); ?>" href="<?php echo e(route('resume.index')); ?>">Resume</a>
                </li>
            
                <!--
                <li class="nav-item me-1">
                    <a class="nav-link <?php echo e(request()->is('subscribe*') ? 'active' : ''); ?>" href="<?php echo e(route('subscribe.index')); ?>">Subscribe</a>
                </li>
                -->
            
                <li class="nav-item me-1">
                    <a class="nav-link <?php echo e(request()->is('article*') ? 'active' : ''); ?>" href="<?php echo e(route('article.index')); ?>">Article</a>
                </li>
            </ul>            

            <form class="d-flex me-3" role="search" action="<?php echo e(route('article.search')); ?>" method="GET">
                <div class="form-group has-search">
                    <span class="fa fa-search form-control-feedback"></span>
                    <input type="text" class="form-control" name="query" value="<?php echo e(request()->query('query')); ?>" placeholder="Looking for a specific article?">
                </div>
            </form>    
            
            <?php if(auth()->guard()->check()): ?>
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <?php
                                        $imagePath = optional(Auth::user())->image_profile;
                                    ?>
    
                                    <?php switch(true):
                                        case ($imagePath && File::exists(public_path($imagePath))): ?>
                                            <img class="img rounded-circle w-25" src="<?php echo e(asset($imagePath)); ?>" alt="User Avatar">
                                            <?php break; ?>
    
                                        <?php case (!$imagePath): ?>
                                            <img class="img rounded-circle w-25" src="https://via.placeholder.com/150" alt="User Avatar">
                                            <?php break; ?>
    
                                        <?php default: ?>
                                            <img class="img rounded-circle w-25" src="https://via.placeholder.com/150" alt="User Avatar">
                                    <?php endswitch; ?>
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                        <li>
                            <h6 class="dropdown-header">Hello, <?php echo e(explode(' ', Auth::user()->name)[0]); ?></h6>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?php echo e(route('dashboard')); ?>" target="_blank">
                                <i class="icon-mid bx bx-world me-2"></i>
                                Go To Dashboard
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="icon-mid bx bx-log-out me-2"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>

            <!--
            <a class="btn-switch-mode me-3" href="">
                <i class='bx bx-sun bx-sm' ></i>
            </a>
            -->

            <!-- 
            <a href="/" class="btn l-btn-primary">Subscribe</a>
            -->

        </div>
    </div>
</nav>
<!-- End Navbar --><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views\frontend\partials\navbar.blade.php ENDPATH**/ ?>