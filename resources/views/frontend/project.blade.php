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
                        <a class="nav-link" href="#">Subscribe</a>
                    </li>

                    <li class="nav-item me-1">
                        <a class="nav-link" href="#">Article</a>
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
                            Nice stuff I've built
                        </h1>
                    </section>

                    <section class="col-lg-12 pb-2">
                    
                        <h5 class="text l-text-dark fw-bold my-3">Side Hustles</h5>
    
                        <!-- Opens source projects -->
                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <div class="card l-card-border-color px-3">
                                    <div class="card-body mt-2">
                                        <div class="circle-container l-card-border-color shadow-sm mb-2">
                                            <div class="circle-content">
                                              <i class='bx bxs-folder-open'></i>
                                            </div>
                                        </div>
                                        <h5 class="l-card-title l-text-dark">Awesome Container Tinkering</h5>
                                        <p class="l-card-text">
                                            Solutions for running containers locally and remotely.
                                        </p>
                                        <div class="row text-end">
                                            <a class="arrow-card-link" href="">
                                                <i class='bx bx-right-arrow-alt bx-sm'></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 mb-4">
                                <div class="card l-card-border-color px-3">
                                    <div class="card-body mt-2">
                                        <div class="circle-container l-card-border-color shadow-sm mb-2">
                                            <div class="circle-content">
                                              <i class='bx bxs-folder-open'></i>
                                            </div>
                                        </div>
                                        <h5 class="l-card-title l-text-dark">Awesome Container Tinkering</h5>
                                        <p class="l-card-text">
                                            Solutions for running containers locally and remotely.
                                        </p>
                                        <div class="row text-end">
                                            <a class="arrow-card-link" href="">
                                                <i class='bx bx-right-arrow-alt bx-sm'></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End opens source projects -->
    
                    </section>

                    <section class="col-lg-12 pb-2">
                    
                        <h5 class="text l-text-dark fw-bold my-3">Client Projects</h5>
    
                        <!-- Opens source projects -->
                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <div class="card l-card-border-color px-3">
                                    <div class="card-body mt-2">
                                        <div class="circle-container l-card-border-color shadow-sm mb-2">
                                            <div class="circle-content">
                                              <i class='bx bxs-folder-open'></i>
                                            </div>
                                        </div>
                                        <h5 class="l-card-title l-text-dark">Awesome Container Tinkering</h5>
                                        <p class="l-card-text">
                                            Solutions for running containers locally and remotely.
                                        </p>
                                        <div class="row text-end">
                                            <a class="arrow-card-link" href="">
                                                <i class='bx bx-right-arrow-alt bx-sm'></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-4">
                                <div class="card l-card-border-color px-3">
                                    <div class="card-body mt-2">
                                        <div class="circle-container l-card-border-color shadow-sm mb-2">
                                            <div class="circle-content">
                                              <i class='bx bxs-folder-open'></i>
                                            </div>
                                        </div>
                                        <h5 class="l-card-title l-text-dark">Awesome Container Tinkering</h5>
                                        <p class="l-card-text">
                                            Solutions for running containers locally and remotely.
                                        </p>
                                        <div class="row text-end">
                                            <a class="arrow-card-link" href="">
                                                <i class='bx bx-right-arrow-alt bx-sm'></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-4">
                                <div class="card l-card-border-color px-3">
                                    <div class="card-body mt-2">
                                        <div class="circle-container l-card-border-color shadow-sm mb-2">
                                            <div class="circle-content">
                                              <i class='bx bxs-folder-open'></i>
                                            </div>
                                        </div>
                                        <h5 class="l-card-title l-text-dark">Awesome Container Tinkering</h5>
                                        <p class="l-card-text">
                                            Solutions for running containers locally and remotely.
                                        </p>
                                        <div class="row text-end">
                                            <a class="arrow-card-link" href="">
                                                <i class='bx bx-right-arrow-alt bx-sm'></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-4">
                                <div class="card l-card-border-color px-3">
                                    <div class="card-body mt-2">
                                        <div class="circle-container l-card-border-color shadow-sm mb-2">
                                            <div class="circle-content">
                                              <i class='bx bxs-folder-open'></i>
                                            </div>
                                        </div>
                                        <h5 class="l-card-title l-text-dark">Awesome Container Tinkering</h5>
                                        <p class="l-card-text">
                                            Solutions for running containers locally and remotely.
                                        </p>
                                        <div class="row text-end">
                                            <a class="arrow-card-link" href="">
                                                <i class='bx bx-right-arrow-alt bx-sm'></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End opens source projects -->
    
                    </section>
                </div>
                <!-- End first col -->

                <!-- Second col -->
                <div class="col-lg-4">
                    <section class="col-lg-12 my-3">
                        <div class="card l-card-border-color px-3">
                            <div class="card-body text-center">
                                <h5 class="l-card-title l-text-dark">Never miss an update!</h5>
                                <p class="l-card-text">Subscribe and join 100K+ developers.</p>
    
                                <form class="mb-3">
                                    <div class="l-form mb-3 mt-4">
                                        <input type="text" class="form-control" placeholder="Your email...">
                                    </div>
                                    <button class="btn l-btn-primary w-100">Subscribe</button>
                                </form>
                                
                            </div>
                        </div>                  
                    </section>
                </div>
                <!-- End second col -->
            </div>

        </div>
    </main>
    <!-- End main content -->

    <footer>
        <div class="container mt-4">
          <hr class="card-hr">
          <div class="row py-4">
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