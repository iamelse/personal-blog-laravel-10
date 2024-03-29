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
                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ route('about.index') }}">About</a>
                </li>
            
                <li class="nav-item me-1">
                    <a class="nav-link {{ request()->is('project') ? 'active' : '' }}" href="{{ route('project.index') }}">Projects</a>
                </li>
            
                <li class="nav-item me-1">
                    <a class="nav-link {{ request()->is('resume') ? 'active' : '' }}" href="{{ route('resume.index') }}">Resume</a>
                </li>
            
                <li class="nav-item me-1">
                    <a class="nav-link {{ request()->is('subscribe') ? 'active' : '' }}" href="{{ route('subscribe.index') }}">Subscribe</a>
                </li>
            
                <li class="nav-item me-1">
                    <a class="nav-link {{ request()->is('article') ? 'active' : '' }}" href="{{ route('article.index') }}">Article</a>
                </li>
            </ul>            

            <form class="d-flex me-3" role="search">
                <div class="form-group has-search">
                    <span class="fa fa-search form-control-feedback"></span>
                    <input type="text" class="form-control">
                </div>
            </form>

            <a class="btn-switch-mode me-3" href="">
                <i class='bx bx-sun bx-sm' ></i>
            </a>

            <!-- 
            <a href="/" class="btn l-btn-primary">Subscribe</a>
            -->

        </div>
    </div>
</nav>
<!-- End Navbar -->