@php
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
@endphp

<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/compiled/svg/logo.svg') }}" alt="Logo" srcset="">
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
                @foreach($sidebarMenuLists as $key => $items)
                    @if(is_int($key))
                        @isset($items['url'])
                            @can($items['permission'] ?? '')
                                <li class="sidebar-item{{ isActive($items['url']) ? ' active' : '' }}">
                                    <a href="{{ url($items['url']) }}" class='sidebar-link' target="{{ $items['new_tab'] ? '_blank' : '_self' }}">
                                        <i class="{{ $items['icon'] }}"></i>
                                        <span>{{ $items['label'] }}</span>
                                    </a>
                                </li>
                            @endcan
                        @endisset
                    @else
                        @if(hasPermission($items))
                            <li class="sidebar-title">{{ $key }}</li>
                            @foreach($items as $item)
                                @if(isset($item['submenu']))
                                    @if(hasPermission($item['submenu']))
                                        <li class="sidebar-item has-sub {{ isSubMenuActive($item['submenu']) ? ' active' : '' }}">
                                            <a href="#" class='sidebar-link'>
                                                <i class="{{ $item['icon'] }}"></i>
                                                <span>{{ $item['label'] }}</span>
                                            </a>
                                            <ul class="submenu {{ isSubMenuActive($item['submenu']) ? 'active' : '' }}">
                                                @foreach($item['submenu'] as $submenuItem)
                                                    @can($submenuItem['permission'])
                                                        <li class="submenu-item {{ isActive($submenuItem['url']) ? 'active' : '' }}">
                                                            <a href="{{ url($submenuItem['url']) }}" class="submenu-link" target="{{ $submenuItem['new_tab'] ? '_blank' : '_self' }}">{{ $submenuItem['label'] }}</a>
                                                        </li>
                                                    @endcan
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @else
                                    @isset($item['url'])
                                        @can($item['permission'])
                                            <li class="sidebar-item{{ isActive($item['url']) ? ' active' : '' }}">
                                                <a href="{{ url($item['url']) }}" class='sidebar-link' target="{{ $item['new_tab'] ? '_blank' : '_self' }}">
                                                    <i class="{{ $item['icon'] }}"></i>
                                                    <span>{{ $item['label'] }}</span>
                                                </a>
                                            </li>
                                        @endcan
                                    @endisset
                                @endif
                            @endforeach
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>