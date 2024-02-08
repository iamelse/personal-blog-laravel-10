<div id="sidebar">
   <div class="sidebar-wrapper active">
       <div class="sidebar-header position-relative">
           <div class="d-flex justify-content-between align-items-center">
               <div class="logo">
                   <a href="index.html">
                       <img src="./assets/compiled/svg/logo.svg" alt="Logo" srcset="">
                   </a>
               </div>
               <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                       role="img" class="iconify iconify--system-uicons" width="20" height="20"
                       preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                       <!-- SVG Path Content -->
                   </svg>
                   <div class="form-check form-switch fs-6">
                       <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                       <label class="form-check-label"></label>
                   </div>
                   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                       role="img" class="iconify iconify--mdi" width="20" height="20"
                       preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                       <!-- SVG Path Content -->
                   </svg>
               </div>
               <div class="sidebar-toggler  x">
                   <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
               </div>
           </div>
       </div>
       <div class="sidebar-menu">
           <ul class="menu">
               <li class="sidebar-title">Menu</li>

               <li class="sidebar-item{{ request()->is('dashboard*') ? ' active' : '' }}">
                    <a href="{{ route('dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="sidebar-title">Article</li>
                
                <li class="sidebar-item{{ request()->is('post-category*') ? ' active' : '' }}">
                    <a href="{{ route('post.category.index') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Category</span>
                    </a>
                </li>
                
                <li class="sidebar-title">Setting</li>
                
                <li class="sidebar-item{{ request()->is('role*') ? ' active' : '' }}">
                    <a href="{{ route('role.index') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Role</span>
                    </a>
                </li>
                
                <li class="sidebar-item{{ request()->is('permission*') ? ' active' : '' }}">
                    <a href="{{ route('permission.index') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Permission</span>
                    </a>
                </li>            

                <!--
                <li class="sidebar-item active has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Layouts</span>
                    </a>
                    <ul class="submenu active">
                        <li class="submenu-item active">
                            <a href="layout-vertical-navbar.html" class="submenu-link">Vertical Navbar</a>
                        </li>
                    </ul>
                </li>
                -->
           </ul>
       </div>
   </div>
</div>