<!-- ===== Sidebar Start ===== -->
<aside
:class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
class="sidebar fixed left-0 top-0 z-40 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0"
>
<!-- SIDEBAR HEADER -->
<div
   :class="sidebarToggle ? 'justify-center' : 'justify-between'"
   class="flex items-center gap-2 pt-8 sidebar-header pb-7"
   >
   <a href="index.html">
   <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
   <img class="dark:hidden" src="{{ asset('tailadmin/images/logo/logo.svg') }}" alt="Logo" />
   <img
      class="hidden dark:block"
      src="{{ asset('tailadmin/images/logo/logo-dark.svg') }}"
      alt="Logo"
      />
   </span>
   <img
      class="logo-icon"
      :class="sidebarToggle ? 'lg:block' : 'hidden'"
      src="{{ asset('tailadmin/images/logo/logo-icon.svg') }}"
      alt="Logo"
      />
   </a>
</div>
<!-- SIDEBAR HEADER -->
<div
   class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar"
   >
   <!-- Sidebar Menu -->
   <nav x-data="{selected: $persist('Dashboard')}">
      <!-- Menu Group -->
      <div>
         <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
            <span
               class="menu-group-title"
               :class="sidebarToggle ? 'lg:hidden' : ''"
               >
            MENU
            </span>
            <svg
               :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
               class="mx-auto fill-current menu-group-icon"
               width="24"
               height="24"
               viewBox="0 0 24 24"
               fill="none"
               xmlns="http://www.w3.org/2000/svg"
               >
               <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                  fill=""
                  />
            </svg>
         </h3>
         @php
            use App\Enums\PermissionEnum;

            $menus = [
               ['parent_route' => 'be.dashboard', 'route' => 'be.dashboard.index', 'icon' => 'bx-line-chart', 'label' => 'Dashboard', 'permission' => PermissionEnum::READ_DASHBOARD],
               ['parent_route' => 'be.role.and.permission', 'route' => 'be.role.and.permission.index', 'icon' => 'bx-user-circle', 'label' => 'Role And Permission', 'permission' => PermissionEnum::READ_ROLE],
               ['parent_route' => 'be.user', 'route' => 'be.user.index', 'icon' => 'bx bx-user', 'label' => 'User', 'permission' => PermissionEnum::READ_USER]
            ];

            $userPermissions = Auth::user()->permissions;
         @endphp

         <ul class="flex flex-col gap-4 mb-6">
            @foreach ($menus as $menu)
               @can($menu['permission'], $userPermissions)
                     <li>
                        <a href="{{ route($menu['route']) }}" 
                           class="menu-item group {{ request()->routeIs($menu['parent_route'] . '*') ? 'menu-item-active' : 'menu-item-inactive' }}">
                           <i class="bx bx-sm {{ $menu['icon'] }}"></i>
                           {{ $menu['label'] }}
                        </a>
                     </li>
               @endcan
            @endforeach
         </ul>
      </div>
   </nav>
   <!-- Sidebar Menu -->
</div>
</aside>
<!-- ===== Sidebar End ===== -->