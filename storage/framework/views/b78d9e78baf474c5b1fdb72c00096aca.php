<?php
    $sidebarMenuLists = [
        ['url' => 'backend/dashboard', 'icon' => 'bx-sm bx bxs-dashboard', 'label' => 'Dashboard', 'permission' => 'view_dashboard', 'new_tab' => false],
        'Menu' => [
            ['url' => 'backend/home', 'icon' => 'bx-sm bx bx-home-alt', 'label' => 'Home', 'permission' => 'view_home', 'new_tab' => false],
            ['url' => 'backend/about', 'icon' => 'bx-sm bx bx-info-circle', 'label' => 'About', 'permission' => 'view_about', 'new_tab' => false],
        ],
        'Projects Tab' => [
            ['url' => 'backend/project', 'icon' => 'bx-sm bx bx-folder', 'label' => 'Project', 'permission' => 'view_projects', 'new_tab' => false],
        ],
        'Resume Tab' => [
            ['url' => 'backend/resume/experience', 'icon' => 'bx-sm bx bx-briefcase', 'label' => 'Experience', 'permission' => 'view_experience', 'new_tab' => false],
            ['url' => 'backend/resume/education', 'icon' => 'bx-sm bx bx-book', 'label' => 'Education', 'permission' => 'view_education', 'new_tab' => false],
            [
                'label' => 'Skills', 'icon' => 'bx-sm bx bx-code', 'submenu' => [
                    ['url' => 'backend/resume/skill/technical', 'label' => 'Technical', 'permission' => 'view_technical_skills', 'new_tab' => false],
                    ['url' => 'backend/resume/skill/language', 'label' => 'Language', 'permission' => 'view_language_skills', 'new_tab' => false],
                ]
            ],
        ],
        'Article Tab' => [
            ['url' => 'backend/post-category', 'icon' => 'bx-sm bx bx-category', 'label' => 'Category', 'permission' => 'view_post_categories', 'new_tab' => false],
            ['url' => 'backend/post', 'icon' => 'bx-sm bx bx-news', 'label' => 'Post', 'permission' => 'view_posts', 'new_tab' => false],
        ],
        'Files' => [
            ['url' => '/laravel-filemanager', 'icon' => 'bx-sm bx bx-file', 'label' => 'Laravel File Manager', 'permission' => 'go_to_laravel_filemanager', 'new_tab' => true],
        ],
        'Setting' => [
            ['url' => 'backend/role', 'icon' => 'bx-sm bx bx-user-circle', 'label' => 'Role', 'permission' => 'view_roles', 'new_tab' => false],
            ['url' => 'backend/user', 'icon' => 'bx-sm bx bx-user', 'label' => 'User', 'permission' => 'view_users', 'new_tab' => false],
            ['url' => 'backend/developer', 'icon' => 'bx-sm bx bx-code-block', 'label' => 'Developer', 'permission' => 'view_developer', 'new_tab' => false],
            ['url' => 'backend/log-activity', 'icon' => 'bx-sm bx bx-time-five', 'label' => 'Log Activity', 'permission' => 'view_log_activity', 'new_tab' => false],
        ],
        'Details' => [
            ['url' => 'backend/details/information', 'icon' => 'bx-sm bx bx-help-circle', 'label' => 'Information', 'permission' => 'view_information', 'new_tab' => false],
        ],
    ];

    function hasPermission($items) {
        foreach ($items as $item) {
            if (isset($item['submenu'])) {
                if (hasPermission($item['submenu'])) {
                    return true;
                }
            } elseif (isset($item['permission']) && auth()->user()->can($item['permission'])) {
                return true;
            }
        }
        return false;
    }

    function isActive($url) {
        $currentUrl = request()->path();
        
        if (Str::startsWith($currentUrl, trim($url, '/'))) {
            return !(
                ($url === 'backend/post-category' && Str::startsWith($currentUrl, 'backend/post') && !Str::startsWith($currentUrl, 'backend/post-category')) ||
                ($url === 'backend/post' && Str::startsWith($currentUrl, 'backend/post-category'))
            );
        }
        return false;
    }

    function isSubMenuActive($submenu) {
        foreach ($submenu as $item) {
            if (isActive($item['url'])) {
                return true;
            }
        }
        return false;
    }
?>

<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="<?php echo e(route('dashboard')); ?>">
                        <img src="<?php echo e(asset('assets/compiled/svg/logo.svg')); ?>" alt="Logo" srcset="">
                    </a>
                </div>
                <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" viewBox="0 0 21 21">
                        <!-- SVG Path Content -->
                    </svg>
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                        <label class="form-check-label"></label>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" viewBox="0 0 24 24">
                        <!-- SVG Path Content -->
                    </svg>
                </div>
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <?php $__currentLoopData = $sidebarMenuLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(is_int($key)): ?>
                        <?php if(isset($items['url'])): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($items['permission'] ?? '')): ?>
                                <li class="sidebar-item<?php echo e(isActive($items['url']) ? ' active' : ''); ?>">
                                    <a href="<?php echo e(url($items['url'])); ?>" class='sidebar-link' target="<?php echo e($items['new_tab'] ? '_blank' : '_self'); ?>">
                                        <i class="<?php echo e($items['icon']); ?>"></i>
                                        <span><?php echo e($items['label']); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if(hasPermission($items)): ?>
                            <li class="sidebar-title"><?php echo e($key); ?></li>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($item['submenu'])): ?>
                                    <?php if(hasPermission($item['submenu'])): ?>
                                        <li class="sidebar-item has-sub <?php echo e(isSubMenuActive($item['submenu']) ? ' active' : ''); ?>">
                                            <a href="#" class='sidebar-link'>
                                                <i class="<?php echo e($item['icon']); ?>"></i>
                                                <span><?php echo e($item['label']); ?></span>
                                            </a>
                                            <ul class="submenu <?php echo e(isSubMenuActive($item['submenu']) ? 'active' : ''); ?>">
                                                <?php $__currentLoopData = $item['submenu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenuItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($submenuItem['permission'])): ?>
                                                        <li class="submenu-item <?php echo e(isActive($submenuItem['url']) ? 'active' : ''); ?>">
                                                            <a href="<?php echo e(url($submenuItem['url'])); ?>" class="submenu-link" target="<?php echo e($submenuItem['new_tab'] ? '_blank' : '_self'); ?>"><?php echo e($submenuItem['label']); ?></a>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if(isset($item['url'])): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($item['permission'])): ?>
                                            <li class="sidebar-item<?php echo e(isActive($item['url']) ? ' active' : ''); ?>">
                                                <a href="<?php echo e(url($item['url'])); ?>" class='sidebar-link' target="<?php echo e($item['new_tab'] ? '_blank' : '_self'); ?>">
                                                    <i class="<?php echo e($item['icon']); ?>"></i>
                                                    <span><?php echo e($item['label']); ?></span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views\partials\sidebar.blade.php ENDPATH**/ ?>