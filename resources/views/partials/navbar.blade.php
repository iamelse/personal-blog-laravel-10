<nav class="navbar navbar-expand navbar-light navbar-top">
   <div class="container-fluid">
       <a href="#" class="burger-btn d-block">
           <i class="bi bi-justify fs-3"></i>
       </a>
       <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
           data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
           aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
           <ul class="navbar-nav ms-auto mb-lg-0">
               <li class="nav-item dropdown me-3">
                   <a class="nav-link active dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown"
                       data-bs-display="static" aria-expanded="false">
                       <i class='bi bi-bell bi-sub fs-4'></i>
                       <span class="badge badge-notification bg-danger">7</span>
                   </a>
                   <ul class="dropdown-menu dropdown-menu-end notification-dropdown"
                       aria-labelledby="dropdownMenuButton">
                       <li class="dropdown-header">
                           <h6>Notifications</h6>
                       </li>
                       <li class="dropdown-item notification-item">
                           <a class="d-flex align-items-center" href="#">
                               <div class="notification-icon bg-primary">
                                   <i class="bi bi-cart-check"></i>
                               </div>
                               <div class="notification-text ms-4">
                                   <p class="notification-title font-bold">Successfully check out</p>
                                   <p class="notification-subtitle font-thin text-sm">Order ID #256</p>
                               </div>
                           </a>
                       </li>
                       <li class="dropdown-item notification-item">
                           <a class="d-flex align-items-center" href="#">
                               <div class="notification-icon bg-success">
                                   <i class="bi bi-file-earmark-check"></i>
                               </div>
                               <div class="notification-text ms-4">
                                   <p class="notification-title font-bold">Homework submitted</p>
                                   <p class="notification-subtitle font-thin text-sm">Algebra math homework</p>
                               </div>
                           </a>
                       </li>
                       <li>
                           <p class="text-center py-2 mb-0"><a href="#">See all notification</a></p>
                       </li>
                   </ul>
               </li>
           </ul>
           <div class="dropdown">
               <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                   <div class="user-menu d-flex">
                       <div class="user-name text-end me-3">
                            @php
                                $nameArray = explode(' ', Auth::user()->name);
                                $firstName = implode(' ', array_slice($nameArray, 0, 2));
                            @endphp
                            <h6 class="mb-0 text-gray-600">{{ $firstName }}</h6>
                            <p class="mb-0 text-sm text-gray-600">{{ Auth::user()->roles[0]->name }}</p>
                       </div>
                       <div class="user-img d-flex align-items-center">
                            <div class="avatar avatar-md">
                                @php
                                    $imagePath = optional(Auth::user())->image_profile;
                                @endphp

                                @switch(true)
                                    @case($imagePath && File::exists(public_path($imagePath)))
                                        <img src="{{ asset($imagePath) }}" alt="User Avatar">
                                        @break

                                    @case(!$imagePath)
                                        <img src="https://via.placeholder.com/150" alt="User Avatar">
                                        @break

                                    @default
                                        <img src="https://via.placeholder.com/150" alt="User Avatar">
                                @endswitch
                            </div>
                       </div>
                   </div>
               </a>
               <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                   style="min-width: 11rem;">
                   <li>
                       <h6 class="dropdown-header">Hello, {{ explode(' ', Auth::user()->name)[0] }}</h6>
                   </li>
                   <li>
                       <a class="dropdown-item" href="{{ route('profile.index') }}"><i class="icon-mid bi bi-person me-2"></i> My
                           Profile
                       </a>
                   </li>
                   <li>
                       <hr class="dropdown-divider">
                   </li>
                   <li>
                       <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                           <i class="icon-mid bi bi-box-arrow-left me-2"></i>
                           Logout
                       </a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST">
                           @csrf
                       </form>
                   </li>
               </ul>
           </div>
       </div>
   </div>
</nav>