@php
    $sidebarMenuLists = [
        ['route' => 'dashboard', 'icon' => 'bx bx-home', 'label' => 'Dashboard', 'permission' => 'view_dashboard'],
        'Menu' => [
            ['route' => 'backend.home.index', 'icon' => 'bx bx-home-alt', 'label' => 'Home', 'permission' => 'view_home'],
            ['route' => 'backend.about.index', 'icon' => 'bx bx-info-circle', 'label' => 'About', 'permission' => 'view_about'],
        ],
        'Projects Tab' => [
            ['route' => 'backend.project.index', 'icon' => 'bx bx-folder', 'label' => 'Project', 'permission' => 'view_projects'],
        ],
        'Resume Tab' => [
            ['route' => 'experience.index', 'icon' => 'bx bx-briefcase', 'label' => 'Experience', 'permission' => 'view_experience'],
            ['route' => 'education.index', 'icon' => 'bx bx-book', 'label' => 'Education', 'permission' => 'view_education'],
            [
                'label' => 'Skills', 'icon' => 'bx bx-code', 'submenu' => [
                    ['route' => 'skill.technical.index', 'label' => 'Technical', 'permission' => 'view_technical_skills'],
                    ['route' => 'skill.language.index', 'label' => 'Language', 'permission' => 'view_language_skills'],
                ]
            ],
        ],
        'Article Tab' => [
            ['route' => 'post.category.index', 'icon' => 'bx bx-category', 'label' => 'Category', 'permission' => 'view_post_categories'],
            ['route' => 'post.index', 'icon' => 'bx bx-news', 'label' => 'Post', 'permission' => 'view_posts'],
        ],
        'Setting' => [
            ['route' => 'role.index', 'icon' => 'bx bx-user-circle', 'label' => 'Role', 'permission' => 'view_roles'],
            ['route' => 'user.index', 'icon' => 'bx bx-user', 'label' => 'User', 'permission' => 'view_users'],
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
                        @can($items['permission'] ?? '')
                            <li class="sidebar-item{{ request()->routeIs($items['route']) ? ' active' : '' }}">
                                <a href="{{ route($items['route']) }}" class='sidebar-link'>
                                    <i class="{{ $items['icon'] }}"></i>
                                    <span>{{ $items['label'] }}</span>
                                </a>
                            </li>
                        @endcan
                    @else
                        @if(hasPermission($items))
                            <li class="sidebar-title">{{ $key }}</li>
                            @foreach($items as $item)
                                @if(isset($item['submenu']))
                                    @if(hasPermission($item['submenu']))
                                        <li class="sidebar-item has-sub {{ request()->is('backend/resume/skill*') ? ' active' : '' }}">
                                            <a href="#" class='sidebar-link'>
                                                <i class="{{ $item['icon'] }}"></i>
                                                <span>{{ $item['label'] }}</span>
                                            </a>
                                            <ul class="submenu active">
                                                @foreach($item['submenu'] as $submenuItem)
                                                    @can($submenuItem['permission'])
                                                        <li class="submenu-item {{ request()->routeIs($submenuItem['route']) ? 'active' : '' }}">
                                                            <a href="{{ route($submenuItem['route']) }}" class="submenu-link">{{ $submenuItem['label'] }}</a>
                                                        </li>
                                                    @endcan
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @else
                                    @can($item['permission'])
                                        <li class="sidebar-item{{ request()->routeIs($item['route']) ? ' active' : '' }}">
                                            <a href="{{ route($item['route']) }}" class='sidebar-link'>
                                                <i class="{{ $item['icon'] }}"></i>
                                                <span>{{ $item['label'] }}</span>
                                            </a>
                                        </li>
                                    @endcan
                                @endif
                            @endforeach
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>