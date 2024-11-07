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
                <div class="col-lg-12">

                    <section class="col-lg-12 pb-2">
                        <h1 class="text l-text-dark display-5 fw-bold">
                            An Interactive Guide to Flexbox
                        </h1>
                    </section>

                    <section class="col-lg-12 pb-2">
                    
                        <h5 class="text l-text-dark fw-bold my-3">Short Bio</h5>
    
                        <p class="l-text-p">
                            I'm a software engineer with more than 10 years of experience in a variety of domains.
                            For the past few years, I've focused on highload server-side projects, 
                            distributed systems, and platform development - tinkering with infrastructure, 
                            all things containers and Cloud Native. 
                        </p>
                        <p class="l-text-p">
                            While there isn't a Wikipedia page about me (sorry folks!), a media bio is available below. 
                        </p>

                        <h5 class="text l-text-dark fw-bold my-3">Career</h5>
    
                        <p class="l-text-p">
                            In my role as a Senior Software Engineer for Google Chrome, 
                            I am responsible for developing and maintaining the Chrome Web Browser.  
                        </p>
                        <p class="l-text-p">
                            My work involves developing and testing new features, 
                            optimizing performance and security, and ensuring the 
                            browser works for users around the world. 
                            I also work closely with other Google teams ensure Chrome 
                            is well-integrated with other Google products and services. 
                        </p>
                        <p class="l-text-p">
                            As CTO of AppForYou, I am responsible for leading the technical 
                            teamand developing the company's technology strategy. 
                            I work closely with the engineering team to ensure that 
                            the products and services we provide are secure. 
                        </p>
    
                    </section>
                </div>
                <!-- End first col -->

                <div class="my-3"></div>

                <!-- Second col -->
                <div class="col-lg-12">
                    <h5 class="text l-text-dark fw-bold my-3">Recommendations</h5>
                    <section class="col-lg-12 my-3">
                        <div class="row card-list">
                            <div class="col-lg-6">
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

                            <div class="col-lg-6">
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

                            <div class="col-lg-6">
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

                            <div class="col-lg-6">
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


</html><?php /**PATH C:\Users\lanas\Documents\Codelabs\Laravel\personal-blog-laravel-10\resources\views\frontend\a-post.blade.php ENDPATH**/ ?>