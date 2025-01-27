@extends('frontend.template.main')

@section('content')
    <!-- Main content -->
    <main>
        <div class="container">
            <!-- First row -->
            <div class="row">
                <!-- First col -->
                <div class="col-lg-8">
                    <section class="col-lg-12 pb-2">
                    
                        @if ($home)
                            @if ($home->image)
                                <div class="container mb-3">
                                    <img src="{{ getHomeImageProfile($home) }}" class="rounded-circle img-fluid" style="width: 75px; height: 75px; object-fit: cover;">
                                </div>
                            @elseif ($home->url)
                                <div class="container mb-3">
                                    <img src="{{ $home->url }}" class="rounded-circle img-fluid" style="width: 75px; height: 75px; object-fit: cover;">
                                </div>
                            @endif
                            
                            {!! $home ? $home->body : '<p class="text text-center l-text-p">No Data</p>' !!}
                        @else
                            
                        @endif
                    </section>
                </div>
                <!-- End first col -->
            </div>
            <!-- End first row -->

            <!-- Second row -->
            <div class="row">
                <!-- First col -->
                <div class="col-lg-8">
                    @unless($postCategories->isEmpty())
                        <section class="pb-2">
                            <h5 class="text l-text-dark fw-bold my-3">Latest Articles</h5>

                            <!-- Tab -->
                            <ul class="nav nav-underline">
                                @forelse ($postCategories as $category)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab{{ ucfirst($category->slug) }}" data-bs-toggle="pill" href="#content{{ ucfirst($category->slug) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @empty

                                @endforelse
                                <!--
                                <li class="nav-item">
                                    <a class="nav-link active" id="tabCoding" data-bs-toggle="pill" href="#contentCoding">Coding</a>
                                </li>
                                -->
                            </ul>
            
                            <div class="tab-content">
                                @forelse ($postCategories as $category)
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="content{{ ucfirst($category->slug) }}">
                                        <div class="card-list">
                                            @forelse ($category->posts->take(5) as $post)
                                                <div class="card flex-row border-0">
                                                    <img class="card-img-left l-card-img align-self-center" src="{{ getPostCoverImage($post) }}" alt="{{ $post->title }}" />
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
                                                <p class="l-text-p my-3 text-center">No posts available in this category.</p>
                                            @endforelse
                                        </div>
                                    </div>
                                @empty
                                    
                                @endforelse
                            </div>                            
                            <!-- End tab -->
        
                        </section>
                    @else
                        <p class="l-text-p text my-3 text-center">No data.</p>
                    @endunless
                </div>
                <!-- End first col -->
                <!--
                <div class="col-lg-4">
                    <section class="my-3">
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
                -->
            </div>
            <!-- End second row -->
            
            <!-- Third row -->
            <div class="row">
                <div class="col-lg-8">
                    <section class="">
                        <h5 class="text l-text-dark fw-bold my-3">Open-Source Projects</h5>
                        <!-- Opens source projects -->
                        <div class="row">
                            @forelse ($projects as $project)
                                <div class="col-lg-6 col-md-6 col-sm-6 pb-3">
                                    <div class="card l-card-border-color px-3">
                                        <div class="card-body mt-2">
                                            <div class="circle-container l-card-border-color shadow-sm mb-2">
                                                <div class="circle-content">
                                                <i class='bx bxs-folder-open'></i>
                                                </div>
                                            </div>
                                            <h5 class="l-card-title l-text-dark">{{ $project->title }}</h5>
                                            <p class="l-card-text">
                                                {!! \Illuminate\Support\Str::limit(strip_tags($project->desc), 80) !!}
                                            </p>
                                            <div class="row text-end">
                                                <a class="arrow-card-link" href="{{ route('project.show', $project->slug) }}">
                                                    <i class='bx bx-right-arrow-alt bx-sm'></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text text-center l-text-p">No Data</p>
                            @endforelse
                        </div>
                        <!-- End opens source projects -->
                    </section>
                </div>
            </div>
            <!-- End third row -->
        </div>
    </main>
    <!-- End main content -->
@endsection

@push('scripts')

@endpush