<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <title>Hello World!</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar fixed-top py-3 navbar-expand-lg bg-white">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                    <li class="nav-item me-1">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>

                    <li class="nav-item me-1">
                        <a class="nav-link" href="/about">About</a>
                    </li>

                    <li class="nav-item me-1">
                        <a class="nav-link" href="/project">Projects</a>
                    </li>

                    <li class="nav-item me-1">
                        <a class="nav-link" href="/resume">Resume</a>
                    </li>

                    <li class="nav-item me-1">
                        <a class="nav-link" href="/subscribe">Subscribe</a>
                    </li>

                    <li class="nav-item me-1">
                        <a class="nav-link" href="/article">Article</a>
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

                <a href="/" class="btn l-btn-primary">Subscribe</a>
                              

            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Main content -->
    <main>
        <div class="container">

            <div class="row">
                <!-- First col -->
                <div class="col-lg-8">

                    <section class="col-lg-12 pb-2">
                        <h1 class="text l-text-dark display-5 fw-bold">
                            Never miss an update ✨
                        </h1>
                    </section>

                    <section class="col-lg-12 pb-2">
    
                        <p class="l-text-p pb-3">
                            This newsletter is written by Mark Ivings, 
                            who previously worked at Google, Medium, Vimeo, 
                            and Qonto. Here is what to expect by subscribing:
                        </p>

                        <p class="l-text-p">
                            <span class="dash-date-list-card fw-bold fs-6">
                                ✓ 
                                &nbsp;
                            </span>
                            Big tech and high-growth startups, from the inside.
                        </p>

                        <p class="l-text-p">
                            <span class="dash-date-list-card fw-bold fs-6">
                                ✓ 
                                &nbsp;
                            </span>
                            Actionable advice for engineering managers, software engineers and tech workers.
                        </p>

                        <p class="l-text-p">
                            <span class="dash-date-list-card fw-bold fs-6">
                                ✓ 
                                &nbsp;
                            </span>
                            A pulse on the tech market and scoop worth knowing.
                        </p>

                        <p class="l-text-p">
                            <span class="dash-date-list-card fw-bold fs-6">
                                ✓ 
                                &nbsp;
                            </span>
                            An independent viewpoint.
                        </p>
    
                    </section>

                    <section class="col-lg-12 pt-3">
                        <form class="d-flex">
                            <div class="form-group l-form me-3">
                                <input type="text" class="form-control" placeholder="Your email...">
                            </div>

                            <button class="btn l-btn-primary">
                                Subscribe
                            </button>
                        </form>
                    </section>

                </div>
                <!-- End first col -->

                <!-- Second col -->
                <div class="col-lg-4">
                </div>
                <!-- End second col -->
            </div>

        </div>
    </main>
    <!-- End main content -->

    <footer class="mt-auto">
        <div class="container">
          <hr class="card-hr">
          <div class="row">
            <div class="col-md-6">
              <p class="text l-text-p l-card-text">Copyright © Iamelse. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end">
              <!-- Social Media Icons with Boxicons -->
              <ul class="list-inline">
                <li class="list-inline-item">
                  <a href="#" target="_blank" title="Facebook">
                    <i class='bx bxl-facebook l-text-p bx-sm text l-text-primary'></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#" target="_blank" title="Instagram">
                    <i class='bx bxl-instagram l-text-p bx-sm text l-text-primary'></i>
                  </a>
                </li>
                <!-- Add more social media icons as needed -->
              </ul>
            </div>
          </div>
        </div>
      </footer>

</body>


</html>