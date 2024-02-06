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
                            My latest update
                        </h1>
                    </section>

                    <section class="col-lg-12 pb-2">
    
                        <p class="l-text-p pb-3">
                            This newsletter is written by Mark Ivings, 
                            who previously worked at Google, Medium, Vimeo, 
                            and Qonto. Here is what to expect by subscribing:
                        </p>

                        <div class="card-list">
                            <div class="card flex-row border-0">
                                <img class="card-img-left l-card-img align-self-center" src="https://preview.cruip.com/devspace/images/post-thumb-01.jpg"/>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <span class="dash-date-list-card">—</span>
                                            <span class="date-list-card">DEC 24, 2023</span>
                                            <a href="">
                                                <h5 class="l-card-title h5 h4-sm mt-1 l-text-dark">An Interactive Guide to Flexbox</h5>
                                            </a>
                                            <p class="l-card-text">Flexbox is a remarkably flexible layout mode. When we understand how it works, we can build responsive designs that rearrange themselves as needed.</p>
                                        </div>
                                        <a class="arrow-card-link mt-5 ms-4" href="">
                                            <i class='bx bx-right-arrow-alt bx-sm align-self-center mt-2'></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr class="card-hr">

                            <div class="card flex-row border-0">
                                <img class="card-img-left l-card-img align-self-center" src="https://preview.cruip.com/devspace/images/post-thumb-01.jpg"/>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <span class="dash-date-list-card">—</span>
                                            <span class="date-list-card">DEC 24, 2023</span>
                                            <a href="">
                                                <h5 class="l-card-title h5 h4-sm mt-1 l-text-dark">An Interactive Guide to Flexbox</h5>
                                            </a>
                                            <p class="l-card-text">Flexbox is a remarkably flexible layout mode. When we understand how it works, we can build responsive designs that rearrange themselves as needed.</p>
                                        </div>
                                        <a class="arrow-card-link mt-5 ms-4" href="">
                                            <i class='bx bx-right-arrow-alt bx-sm align-self-center mt-2'></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr class="card-hr">

                            <div class="card flex-row border-0">
                                <img class="card-img-left l-card-img align-self-center" src="https://preview.cruip.com/devspace/images/post-thumb-01.jpg"/>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <span class="dash-date-list-card">—</span>
                                            <span class="date-list-card">DEC 24, 2023</span>
                                            <a href="">
                                                <h5 class="l-card-title h5 h4-sm mt-1 l-text-dark">An Interactive Guide to Flexbox</h5>
                                            </a>
                                            <p class="l-card-text">Flexbox is a remarkably flexible layout mode. When we understand how it works, we can build responsive designs that rearrange themselves as needed.</p>
                                        </div>
                                        <a class="arrow-card-link mt-5 ms-4" href="">
                                            <i class='bx bx-right-arrow-alt bx-sm align-self-center mt-2'></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr class="card-hr">

                            <div class="card flex-row border-0">
                                <img class="card-img-left l-card-img align-self-center" src="https://preview.cruip.com/devspace/images/post-thumb-01.jpg"/>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <span class="dash-date-list-card">—</span>
                                            <span class="date-list-card">DEC 24, 2023</span>
                                            <a href="">
                                                <h5 class="l-card-title h5 h4-sm mt-1 l-text-dark">An Interactive Guide to Flexbox</h5>
                                            </a>
                                            <p class="l-card-text">Flexbox is a remarkably flexible layout mode. When we understand how it works, we can build responsive designs that rearrange themselves as needed.</p>
                                        </div>
                                        <a class="arrow-card-link mt-5 ms-4" href="">
                                            <i class='bx bx-right-arrow-alt bx-sm align-self-center mt-2'></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr class="card-hr">

                            <div class="card flex-row border-0">
                                <img class="card-img-left l-card-img align-self-center" src="https://preview.cruip.com/devspace/images/post-thumb-01.jpg"/>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <span class="dash-date-list-card">—</span>
                                            <span class="date-list-card">DEC 24, 2023</span>
                                            <a href="">
                                                <h5 class="l-card-title h5 h4-sm mt-1 l-text-dark">An Interactive Guide to Flexbox</h5>
                                            </a>
                                            <p class="l-card-text">Flexbox is a remarkably flexible layout mode. When we understand how it works, we can build responsive designs that rearrange themselves as needed.</p>
                                        </div>
                                        <a class="arrow-card-link mt-5 ms-4" href="">
                                            <i class='bx bx-right-arrow-alt bx-sm align-self-center mt-2'></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr class="card-hr">

                            <div class="card flex-row border-0">
                                <img class="card-img-left l-card-img align-self-center" src="https://preview.cruip.com/devspace/images/post-thumb-01.jpg"/>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <span class="dash-date-list-card">—</span>
                                            <span class="date-list-card">DEC 24, 2023</span>
                                            <a href="">
                                                <h5 class="l-card-title h5 h4-sm mt-1 l-text-dark">An Interactive Guide to Flexbox</h5>
                                            </a>
                                            <p class="l-card-text">Flexbox is a remarkably flexible layout mode. When we understand how it works, we can build responsive designs that rearrange themselves as needed.</p>
                                        </div>
                                        <a class="arrow-card-link mt-5 ms-4" href="">
                                            <i class='bx bx-right-arrow-alt bx-sm align-self-center mt-2'></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr class="card-hr">
                        </div>
    
                    </section>

                </div>
                <!-- End first col -->

                <!-- Second col -->
                <div class="col-lg-4">
                    <section class="my-3">
                        <div class="card l-card-border-color px-3">
                            <div class="card-body">
                                <h5 class="l-card-title l-text-dark text-center">Filter</h5>
                                <h6 class="l-text-dark fw-bold fs-6">Category</h6>
                                <h6 class="l-text-dark fw-bold fs-6">Author</h6>
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