@extends('frontend.template.main')

@section('content')
    <!-- Main content -->
    <main>
        <div class="container">

            <div class="row">
                <!-- First col -->
                <div class="col-lg-8">

                    <section class="col-lg-12 pb-2">
                        <h1 class="text l-text-dark display-5 fw-bold">
                            Archived Posts
                        </h1>
                    </section>

                    <section class="col-lg-12 pb-2">
    
                        <p class="l-text-p pb-3">
                            Welcome to my archive. These posts reflect past thoughts, ideas, and experiences that are still valuable.
                        </p>

                        <div class="card-list mt-3">
                            @forelse ($posts as $post)
                            <div class="card flex-row border-0">
                                <img class="card-img-left l-card-img align-self-center" src="{{ getPostCoverImage($post) }}"/>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <span class="dash-date-list-card">—</span>
                                            <span class="date-list-card text-uppercase">{{ \Carbon\Carbon::parse($post->created_at)->format('M d, Y') }}</span>
                                            <a href="{{ route('article.show', $post->slug) }}">
                                                <h5 class="l-card-title h5 h4-sm mt-1 l-text-dark">{{ $post->title }}</h5>
                                            </a>
                                            <p class="l-card-text">{{ \Illuminate\Support\Str::limit(strip_tags($post->body), 170) }}</p>
                                        </div>
                                        <a class="arrow-card-link mt-5 ms-4" href="{{ route('article.show', $post->slug) }}">
                                            <i class='bx bx-right-arrow-alt bx-sm align-self-center mt-2'></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr class="card-hr">
                            @empty
                            <div class="row">
                                <div class="col-12 text-center">
                                    <p class="l-card-text">
                                        No archived posts available at the moment.
                                    </p>
                                </div>
                            </div>
                            @endforelse
                        </div>
                        <!-- Pagination links -->
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                {{ $posts->links() }}
                            </div>
                        </div>
    
                    </section>

                </div>
                <!-- End first col -->

            </div>

        </div>
    </main>
    <!-- End main content -->
@endsection