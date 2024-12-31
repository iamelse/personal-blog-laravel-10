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
                    <span id="notificationCounter" class="badge badge-notification bg-danger" 
                        style="display: {{ $unreadCount > 0 ? 'inline' : 'none' }};">
                        {{ $unreadCount }}
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end notification-dropdown"
                    aria-labelledby="dropdownMenuButton">
                    <li class="dropdown-header">
                        <h6>Notifications</h6>
                    </li>
                    @if($notifications->isEmpty() || $notifications->whereNull('read_at')->isEmpty())
                        <li class="dropdown-item notification-item">
                            <p class="text-center py-1 mb-0 notification-subtitle font-thin text-sm text-gray-500">You are all set! No new notifications.</p>
                        </li>
                    @else
                        @foreach($notifications as $notification)
                            @if(is_null($notification->read_at))
                                <li class="dropdown-item notification-item" id="notification-{{ $notification->id }}" data-id="{{ $notification->id }}" data-url="{{ $notification->data['data']['url'] ?? '#' }}">
                                    <a class="d-flex align-items-center">
                                        <div class="notification-icon {{ $notification->data['data']['background'] ?? 'bg-secondary' }}">
                                            {!! $notification->data['data']['icon'] ?? '<i class="bi bi-info-circle"></i>' !!}
                                        </div>
                                        <div class="notification-text ms-4">
                                            <p class="notification-title font-bold">{{ $notification->data['data']['title'] ?? 'Notification' }}</p>
                                            <p class="notification-subtitle font-thin text-sm">{!! $notification->data['data']['description'] ?? 'No details available.' !!}</p>
                                        </div>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                    <li>
                        <p class="text-center py-2 mb-0"><a href="#">See all notifications</a></p>
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
                                <img src="{{ getUserImageProfilePath(Auth::user()) }}" alt="">
                            </div>
                       </div>
                   </div>
               </a>
               <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                    <li>
                        <h6 class="dropdown-header">Hello, {{ explode(' ', Auth::user()->name)[0] }}</h6>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('home.index') }}" target="_blank">
                            <i class="icon-mid bx bx-world me-2"></i>
                            View Website
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class="icon-mid bx bx-user me-2"></i>
                            My Profile
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="icon-mid bx bx-log-out me-2"></i>
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