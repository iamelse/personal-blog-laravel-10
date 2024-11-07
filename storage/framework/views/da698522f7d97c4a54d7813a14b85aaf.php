<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>

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
                            My Resume
                        </h1>
                    </section>

                    <section class="col-lg-12 pb-2">
                    
                        <h5 class="text l-text-dark fw-bold my-3">Education</h5>

                        <div class="row mb-2">
                            <div class="col-1">
                                <div class="l-circle-container l-card-border-color shadow-sm mb-2">
                                    <div class="l-circle-content">
                                        <img style="width: 2.5rem;" src="https://media.licdn.com/dms/image/C560BAQEoyrFTMXUzfQ/company-logo_200_200/0/1630641536852?e=2147483647&v=beta&t=CFe-X1z8WrD6wSVkivXQng_vxHgaN1_oOFZO6Gr72FU" alt="">
                                        <!-- <i class='bx bxs-folder-open'></i> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col ps-4">
                                <span class="date-list-card">DEC 24, 2023 . PRESENT</span>
                                <h6 class="l-text-dark fw-bold mt-2">Senior Front-end Engineer</h6>
                                <h6 class="l-text-dark">Google</h6>
                                <p class="l-card-text">
                                    In my role as a Senior Software Engineer for Google, 
                                    I am responsible for developing and maintaining the 
                                    Chrome Web Experience.
                                </p>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-1">
                                <div class="l-circle-container l-card-border-color shadow-sm mb-2">
                                    <div class="l-circle-content">
                                        <img style="width: 2.5rem;" src="https://media.licdn.com/dms/image/C560BAQEoyrFTMXUzfQ/company-logo_200_200/0/1630641536852?e=2147483647&v=beta&t=CFe-X1z8WrD6wSVkivXQng_vxHgaN1_oOFZO6Gr72FU" alt="">
                                        <!-- <i class='bx bxs-folder-open'></i> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col ps-4">
                                <span class="date-list-card">DEC 24, 2023 . PRESENT</span>
                                <h6 class="l-text-dark fw-bold mt-2">Senior Front-end Engineer</h6>
                                <h6 class="l-text-dark">Google</h6>
                                <p class="l-card-text">
                                    In my role as a Senior Software Engineer for Google, 
                                    I am responsible for developing and maintaining the 
                                    Chrome Web Experience.
                                </p>
                            </div>
                        </div>
    
                    </section>

                    <section class="col-lg-12 pb-2">
                    
                        <h5 class="text l-text-dark fw-bold my-3">Experience</h5>

                        <div class="row mb-2">
                            <div class="col-1">
                                <div class="l-circle-container l-card-border-color shadow-sm mb-2">
                                    <div class="l-circle-content">
                                        <img style="width: 2.5rem;" src="https://media.licdn.com/dms/image/C560BAQEoyrFTMXUzfQ/company-logo_200_200/0/1630641536852?e=2147483647&v=beta&t=CFe-X1z8WrD6wSVkivXQng_vxHgaN1_oOFZO6Gr72FU" alt="">
                                        <!-- <i class='bx bxs-folder-open'></i> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col ps-4">
                                <span class="date-list-card">DEC 24, 2023 . PRESENT</span>
                                <h6 class="l-text-dark fw-bold mt-2">Senior Front-end Engineer</h6>
                                <h6 class="l-text-dark">Google</h6>
                                <p class="l-card-text">
                                    In my role as a Senior Software Engineer for Google, 
                                    I am responsible for developing and maintaining the 
                                    Chrome Web Experience.
                                </p>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-1">
                                <div class="l-circle-container l-card-border-color shadow-sm mb-2">
                                    <div class="l-circle-content">
                                        <img style="width: 2.5rem;" src="https://media.licdn.com/dms/image/C560BAQEoyrFTMXUzfQ/company-logo_200_200/0/1630641536852?e=2147483647&v=beta&t=CFe-X1z8WrD6wSVkivXQng_vxHgaN1_oOFZO6Gr72FU" alt="">
                                        <!-- <i class='bx bxs-folder-open'></i> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col ps-4">
                                <span class="date-list-card">DEC 24, 2023 . PRESENT</span>
                                <h6 class="l-text-dark fw-bold mt-2">Senior Front-end Engineer</h6>
                                <h6 class="l-text-dark">Google</h6>
                                <p class="l-card-text">
                                    In my role as a Senior Software Engineer for Google, 
                                    I am responsible for developing and maintaining the 
                                    Chrome Web Experience.
                                </p>
                            </div>
                        </div>
    
                    </section>

                </div>
                <!-- End first col -->

                <!-- Second col -->
                <div class="col-lg-4">
                    <section class="col-lg-12 mt-3 mb-4">
                        <div class="card l-card-border-color px-3">
                            <div class="card-body">
                                <h5 class="l-card-title l-text-dark">Technical Skills</h5>
                                <div class="row mt-3">
                                    <div class="col text-start">
                                        <p class="l-text-dark fw-bold">
                                            <span class="dash-date-list-card">
                                                —
                                                &nbsp;
                                            </span>
                                            React
                                        </p>
                                    </div>
                                    <div class="col text-end">
                                        <p class="l-card-text">Mahir</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-start">
                                        <p class="l-text-dark fw-bold">
                                            <span class="dash-date-list-card">
                                                —
                                                &nbsp;
                                            </span>
                                            Laravel
                                        </p>
                                    </div>
                                    <div class="col text-end">
                                        <p class="l-card-text">Mahir</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-start">
                                        <p class="l-text-dark fw-bold">
                                            <span class="dash-date-list-card">
                                                —
                                                &nbsp;
                                            </span>
                                            Bootstrap
                                        </p>
                                    </div>
                                    <div class="col text-end">
                                        <p class="l-card-text">Mahir</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-start">
                                        <p class="l-text-dark fw-bold">
                                            <span class="dash-date-list-card">
                                                —
                                                &nbsp;
                                            </span>
                                            Tailwind CSS
                                        </p>
                                    </div>
                                    <div class="col text-end">
                                        <p class="l-card-text">Mahir</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-start">
                                        <p class="l-text-dark fw-bold">
                                            <span class="dash-date-list-card">
                                                —
                                                &nbsp;
                                            </span>
                                            React
                                        </p>
                                    </div>
                                    <div class="col text-end">
                                        <p class="l-card-text">Mahir</p>
                                    </div>
                                </div>
                            </div>
                        </div>                  
                    </section>

                    <section class="col-lg-12 mb-4">
                        <div class="card l-card-border-color px-3">
                            <div class="card-body">
                                <h5 class="l-card-title l-text-dark">Languages</h5>
                                <div class="row mt-3">
                                    <div class="col text-start">
                                        <p class="l-text-dark fw-bold">
                                            Indonesia
                                        </p>
                                    </div>
                                    <div class="col text-end">
                                        <p class="l-card-text">Mahir</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-start">
                                        <p class="l-text-dark fw-bold">
                                            English
                                        </p>
                                    </div>
                                    <div class="col text-end">
                                        <p class="l-card-text">Mahir</p>
                                    </div>
                                </div>
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


</html><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views\frontend\resume.blade.php ENDPATH**/ ?>