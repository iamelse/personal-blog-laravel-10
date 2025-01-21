<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Hide archive posts from search engines -->
    <meta name="robots" content="{{ $post->status === \App\Enums\PostStatus::PUBLISHED->value ? 'index, follow' : 'noindex, nofollow' }}">

    <!-- Dynamic Meta Tags -->
    <meta name="title" content="{{ $post->seo && $post->seo->seo_title ? $post->seo->seo_title : $post->title }}">
    <meta name="description" content="{{ $post->seo && $post->seo->seo_description ? $post->seo->seo_description : Str::limit(strip_tags($post->body), 150) }}">
    <meta name="keywords" content="{{ $post->seo && $post->seo->seo_keywords ? Str::of($post->seo->seo_keywords)->lower()->replaceMatches('/\s*,\s*/', ',')->trim(',')->title() : '' }}">
    <meta name="author" content="{{ $post->author ? $post->author->name : '' }}">
    <meta name="category" content="{{ $post->category ? $post->category->name : '' }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $post->seo && $post->seo->seo_title ? $post->seo->seo_title : $post->title }}">
    <meta property="og:description" content="{{ $post->seo && $post->seo->seo_description ? $post->seo->seo_description : Str::limit(strip_tags($post->body), 150) }}">
    <meta property="og:image" content="{{ getPostCoverImage($post) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->seo && $post->seo->seo_title ? $post->seo->seo_title : $post->title }}">
    <meta name="twitter:description" content="{{ $post->seo && $post->seo->seo_description ? $post->seo->seo_description : Str::limit(strip_tags($post->body), 150) }}">
    <meta name="twitter:image" content="{{ getPostCoverImage($post) }}">

    <link rel="icon" href="{{ asset('assets/favicon.png') }}" type="image/png">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' media="print" onload="this.media='all'">

    <!-- Font Awesome CSS loaded asynchronously -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" as="style">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="print" onload="this.media='all'">

    <!-- Your custom app.css loaded asynchronously -->
    <link rel="stylesheet" href="{{ asset('assets/export-vite/css/app.css') }}" media="print" onload="this.media='all'">

    <!-- Defer non-critical JS (app2.js) to avoid blocking rendering -->
    <script src="{{ asset('assets/export-vite/js/app2.js') }}" defer></script>

    <!-- Dynamic Title -->
    <title>{{ $post->title ?? $title ?? env('APP_NAME') }}</title>
</head>

<body class="loading">

    <!-- Loader -->
    <div class="loader" id="loader"></div>

    <!-- Navbar -->
    @include('frontend.partials.navbar')
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
                                <img src="{{ getUserImageProfilePath($post->author) }}" alt="Profile Image" class="me-2 rounded-circle" style="width: 45px; height: 45px; object-fit: cover;">
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
                                    <img class="card-img-left l-card-img align-self-center" src="{{ getPostCoverImage($relatedPost) }}"/>
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

    <!-- Footer -->
    @include('frontend.partials.footer')
    <!-- End Footer -->

    <script>
        window.addEventListener('load', function () {
            setTimeout(function () {
                document.body.classList.remove('loading');
                document.body.classList.add('loaded');
            }, 2000);
        });
    </script>

    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            
            if (window.scrollY > 10) {
                navbar.classList.add('shadow-sm');
            } else {
                navbar.classList.remove('shadow-sm');
            }
        });
    </script>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "BlogPosting",
            "headline": "{{ $post->title }}",
            "image": "{{ getPostCoverImage($post) }}",
            "author": {
                "@type": "Person",
                "name": "{{ $post->author->name }}"
            },
            "datePublished": "{{ $post->created_at->toIso8601String() }}",
            "dateModified": "{{ $post->updated_at->toIso8601String() }}",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "{{ url()->current() }}"
            },
            "description": "{{ Str::limit(strip_tags($post->body), 150) }}"
        }
    </script>
    
</body>


</html>