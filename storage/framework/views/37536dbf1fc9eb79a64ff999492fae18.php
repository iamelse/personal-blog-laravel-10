<?php
    if (!function_exists('isActive')) {
        function isActive($url, $exact = false) {
            if ($exact) {
                return request()->is(trim($url, '/'));
            } else {
                return request()->is(trim($url, '/') . '*');
            }
        }
    }
    
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
            ['url' => 'backend/post-category', 'icon' => 'bx-sm bx bx-category', 'label' => 'Category', 'permission' => 'view_post_categories', 'new_tab' => false, 'exact' => true], // Use 'exact' for Category
            ['url' => 'backend/post', 'icon' => 'bx-sm bx bx-news', 'label' => 'Post', 'permission' => 'view_posts', 'new_tab' => false, 'exact' => true], // Use 'exact' for Post
        ],
        'Files' => [
            ['url' => '/laravel-filemanager', 'icon' => 'bx-sm bx bx-file', 'label' => 'Laravel File Manager', 'permission' => 'go_to_laravel_filemanager', 'new_tab' => true],
        ],
        'Setting' => [
            ['url' => 'backend/social-media', 'icon' => 'bx-sm bx bx-share-alt', 'label' => 'Social Media', 'permission' => 'view_social_media', 'new_tab' => false],
            ['url' => 'backend/role', 'icon' => 'bx-sm bx bx-user-circle', 'label' => 'Role', 'permission' => 'view_roles', 'new_tab' => false],
            ['url' => 'backend/user', 'icon' => 'bx-sm bx bx-user', 'label' => 'User', 'permission' => 'view_users', 'new_tab' => false],
            ['url' => 'backend/developer', 'icon' => 'bx-sm bx bx-code-block', 'label' => 'Developer', 'permission' => 'view_developer', 'new_tab' => false],
            ['url' => 'backend/log-activity', 'icon' => 'bx-sm bx bx-time-five', 'label' => 'Log Activity', 'permission' => 'view_log_activity', 'new_tab' => false],
        ],
        'Details' => [
            ['url' => 'backend/details/information', 'icon' => 'bx-sm bx bx-help-circle', 'label' => 'Information', 'permission' => 'view_information', 'new_tab' => false],
        ],
    ];
?>

<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="<?php echo e(route('dashboard')); ?>">
                        <img src="<?php echo e(asset('assets/compiled/svg/logo.svg')); ?>" alt="Logo">
                    </a>
                </div>
                <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                    <!-- Theme Toggle Buttons -->

                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                        <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                            <g transform="translate(-210 -1)">
                                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                <circle cx="220.5" cy="11.5" r="4"></circle>
                                <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                            </g>
                        </g>
                    </svg>
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                        <label class="form-check-label"></label>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                        </path>
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
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($items['permission'] ?? '')): ?>
                            <li class="sidebar-item<?php echo e(isActive($items['url'], $items['exact'] ?? false) ? ' active' : ''); ?>">
                                <a href="<?php echo e(url($items['url'])); ?>" class='sidebar-link' target="<?php echo e($items['new_tab'] ? '_blank' : '_self'); ?>">
                                    <i class="<?php echo e($items['icon']); ?>"></i>
                                    <span><?php echo e($items['label']); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if(collect($items)->contains(fn($item) => auth()->user()->can($item['permission'] ?? ''))): ?>
                            <li class="sidebar-title"><?php echo e($key); ?></li>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($item['submenu'])): ?>
                                    <?php if(collect($item['submenu'])->contains(fn($submenuItem) => auth()->user()->can($submenuItem['permission'] ?? ''))): ?>
                                        <li class="sidebar-item has-sub <?php echo e(collect($item['submenu'])->contains(fn($submenuItem) => isActive($submenuItem['url'], $submenuItem['exact'] ?? false)) ? ' active' : ''); ?>">
                                            <a href="#" class='sidebar-link'>
                                                <i class="<?php echo e($item['icon']); ?>"></i>
                                                <span><?php echo e($item['label']); ?></span>
                                            </a>
                                            <ul class="submenu <?php echo e(collect($item['submenu'])->contains(fn($submenuItem) => isActive($submenuItem['url'], $submenuItem['exact'] ?? false)) ? 'active' : ''); ?>">
                                                <?php $__currentLoopData = $item['submenu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenuItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($submenuItem['permission'] ?? '')): ?>
                                                        <li class="submenu-item <?php echo e(isActive($submenuItem['url'], $submenuItem['exact'] ?? false) ? 'active' : ''); ?>">
                                                            <a href="<?php echo e(url($submenuItem['url'])); ?>" class="submenu-link" target="<?php echo e($submenuItem['new_tab'] ? '_blank' : '_self'); ?>"><?php echo e($submenuItem['label']); ?></a>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($item['permission'] ?? '')): ?>
                                        <li class="sidebar-item<?php echo e(isActive($item['url'], $item['exact'] ?? false) ? ' active' : ''); ?>">
                                            <a href="<?php echo e(url($item['url'])); ?>" class='sidebar-link' target="<?php echo e($item['new_tab'] ? '_blank' : '_self'); ?>">
                                                <i class="<?php echo e($item['icon']); ?>"></i>
                                                <span><?php echo e($item['label']); ?></span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>