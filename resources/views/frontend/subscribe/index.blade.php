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
                            Never miss an update ✨
                        </h1>
                    </section>

                    <section class="col-lg-12 pb-2">
    
                        <p class="l-text-p pb-3">
                            This newsletter is written by Mark Ivings, 
                            who previously worked at Google, Medium, Vimeo, 
                            and Qonto. Here is what to expect by subscribing:
                        </p>

                        <p class="l-text-p">
                            <span class="dash-date-list-card fw-bold fs-6">
                                ✓ 
                                &nbsp;
                            </span>
                            Big tech and high-growth startups, from the inside.
                        </p>

                        <p class="l-text-p">
                            <span class="dash-date-list-card fw-bold fs-6">
                                ✓ 
                                &nbsp;
                            </span>
                            Actionable advice for engineering managers, software engineers and tech workers.
                        </p>

                        <p class="l-text-p">
                            <span class="dash-date-list-card fw-bold fs-6">
                                ✓ 
                                &nbsp;
                            </span>
                            A pulse on the tech market and scoop worth knowing.
                        </p>

                        <p class="l-text-p">
                            <span class="dash-date-list-card fw-bold fs-6">
                                ✓ 
                                &nbsp;
                            </span>
                            An independent viewpoint.
                        </p>
    
                    </section>

                    <section class="col-lg-12 pt-3">
                        <form class="d-flex">
                            <div class="form-group l-form me-3">
                                <input type="text" class="form-control" placeholder="Your email...">
                            </div>

                            <button class="btn l-btn-primary">
                                Subscribe
                            </button>
                        </form>
                    </section>

                </div>
                <!-- End first col -->

                <!-- Second col -->
                <div class="col-lg-4">
                </div>
                <!-- End second col -->
            </div>

        </div>
    </main>
    <!-- End main content -->
@endsection