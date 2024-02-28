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
                            Nice stuff I've built
                        </h1>
                    </section>

                    <section class="col-lg-12 pb-2">

                        <h5 class="text l-text-dark fw-bold my-3">All of my projects</h5>

                        @forelse ($projects as $project)
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card l-card-border-color px-3">
                                        <div class="card-body mt-2">
                                            <div class="circle-container l-card-border-color shadow-sm mb-2">
                                                <div class="circle-content">
                                                <i class='bx bxs-folder-open'></i>
                                                </div>
                                            </div>
                                            <h5 class="l-card-title l-text-dark">{{ $project->title }}</h5>
                                            <p class="l-card-text">
                                                {{ \Illuminate\Support\Str::limit(strip_tags($project->desc), 100) }}
                                            </p>
                                            <div class="row text-end">
                                                <a class="arrow-card-link" href="{{ route('project.show', $project->slug) }}">
                                                    <i class='bx bx-right-arrow-alt bx-sm'></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        <div class="row">
                            <div class="col-12 text-center">
                                <p class="l-card-text">
                                    No Project Available
                                </p>
                            </div>
                        </div>
                        @endforelse
    
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
@endsection