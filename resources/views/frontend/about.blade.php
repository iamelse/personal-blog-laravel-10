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
                            Hi. I'm <span class="text l-text-primary">Lana Septiana</span>🤟
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
    
                    </section>

                    <section class="col-lg-12 pb-2">
                    
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

                    <section class="col-lg-12 pb-2">
                    
                        <h5 class="text l-text-dark fw-bold my-3">Let's Connect</h5>
    
                        <p class="l-text-p">
                            I'm excited to connect with others via email and Twitter 
                            to chat about projects and ideas. Currently, I'm not taking 
                            on freelance projects, but I am open to hearing about potential 
                            opportunities, discussing them with you and then potentially 
                            collaborating if it's a good fit. 
                        </p>
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