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
                <div class="col-lg-12">

                    <article class="col-lg-12 pb-2">
                        <header>
                            <h1 class="text l-text-dark display-5 fw-bold">
                                {{ $post->title }}
                            </h1>
                            <div class="d-flex align-items-center my-4">
                                <img src="{{ empty($post->author->image_profile) ? 'https://via.placeholder.com/150' : (Storage::disk('public_uploads')->exists($post->author->image_profile) ? asset('uploads/' . $post->author->image_profile) : 'https://via.placeholder.com/150') }}" alt="Profile Image" class="me-2 rounded-circle" style="width: 45px; height: 45px; object-fit: cover;">
                                <div class="post-metadata">
                                    <span class="author l-text-dark">{{ $post->author->name }}</span>
                                    <span class="category l-text-dark">in {{ $post->category->name }}</span>
                                    <div class="time">
                                        @php
                                            $totalWords = str_word_count(strip_tags($post->body));
                                            $readingSpeed = 200;

                                            $estimatedTime = ceil($totalWords / $readingSpeed);
                                        @endphp
                                        <small class="date l-text-p">{{ $estimatedTime }} mins read</small>
                                        <small class="date l-text-p">.</small>
                                        <small class="date l-text-p">{{ \Carbon\Carbon::parse($post->created_at)->format('M d, Y') }}</small>
                                    </div>
                                </div>
                                                                
                            </div>                                                      
                        </header>
                        <div class="content">
                            {!! $post->body !!}
                        </div>
                    </article>                    
                </div>
                <!-- End first col -->

                <div class="my-3"></div>

                <!-- Second col -->
                <div class="col-lg-12">
                    <h5 class="text l-text-dark fw-bold my-3">Recommendations</h5>
                    <section class="col-lg-12 my-3">
                        <div class="row card-list">
                            @forelse ($relatedPosts as $relatedPost)
                            <div class="col-lg-6">
                                <div class="card flex-row border-0">
                                    <img class="card-img-left l-card-img align-self-center" src="{{ $relatedPost->cover }}"/>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <span class="dash-date-list-card">—</span>
                                                <span class="date-list-card text-uppercase">{{ \Carbon\Carbon::parse($relatedPost->created_at)->format('M d, Y') }}</span>
                                                <a href="{{ route('article.show', $relatedPost->slug) }}">
                                                    <h5 class="l-card-title h5 h4-sm mt-1 l-text-dark">{{ $relatedPost->title }}</h5>
                                                </a>
                                                <p class="l-card-text">{{ \Illuminate\Support\Str::limit(strip_tags($relatedPost->body), 100) }}</p>
                                            </div>
                                            <a class="arrow-card-link mt-5 ms-4" href="{{ route('article.show', $relatedPost->slug) }}">
                                                <i class='bx bx-right-arrow-alt bx-sm align-self-center mt-2'></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <hr class="card-hr">
                            </div>
                            @empty
                            <div class="col-lg-12 text-center">
                                <p class="l-card-text">No Data</p>
                            </div>
                            @endforelse
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