<!-- Navbar -->
<nav class="navbar fixed-top py-3 navbar-expand-lg bg-white">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item me-1">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home.index') }}">Home</a>
                </li>
            
                <li class="nav-item me-1">
                    <a class="nav-link {{ request()->is('about*') ? 'active' : '' }}" href="{{ route('about.index') }}">About</a>
                </li>
            
                <li class="nav-item me-1">
                    <a class="nav-link {{ request()->is('project*') ? 'active' : '' }}" href="{{ route('project.index') }}">Projects</a>
                </li>
            
                <li class="nav-item me-1">
                    <a class="nav-link {{ request()->is('resume*') ? 'active' : '' }}" href="{{ route('resume.index') }}">Resume</a>
                </li>
            
                <!--
                <li class="nav-item me-1">
                    <a class="nav-link {{ request()->is('subscribe*') ? 'active' : '' }}" href="{{ route('subscribe.index') }}">Subscribe</a>
                </li>
                -->
            
                <li class="nav-item me-1">
                    <a class="nav-link {{ request()->is('article*') ? 'active' : '' }}" href="{{ route('article.index') }}">Article</a>
                </li>
            </ul>            

            <form class="d-flex me-3" role="search" action="{{ route('article.search') }}" method="GET">
                <div class="form-group has-search">
                    <span class="fa fa-search form-control-feedback"></span>
                    <input type="text" class="form-control" name="query" value="{{ request()->query('query') }}" placeholder="Looking for a specific article?">
                </div>
            </form>    
            
            @auth
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img class="img rounded-circle" src="{{ getUserImageProfilePath(Auth::user()) }}" alt="User Avatar" style="width: 2.5rem; height: auto;">
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                        <li>
                            <h6 class="dropdown-header">Hello, {{ explode(' ', Auth::user()->name)[0] }}</h6>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('dashboard') }}" target="_blank">
                                <i class="icon-mid bx bx-world me-2"></i>
                                Go To Dashboard
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
            @endauth

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
<!-- End Navbar -->