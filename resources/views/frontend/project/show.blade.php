@extends('frontend.template.main')

@section('content')
<!-- Main content -->
<main>
    <div class="container">

        <div class="row">
            <!-- First col -->
            <div class="col-lg-12">

                <article class="col-lg-12 pb-2">
                    <header>
                        <h1 class="text l-text-dark display-5 mb-4 fw-bold">
                            {{ $project->title }}
                        </h1>                                                      
                    </header>
                    <div class="content">
                        {!! $project->desc !!}
                    </div>
                </article>                    
            </div>
            <!-- End first col -->

            <div class="my-3"></div>

        </div>

    </div>
</main>
<!-- End main content -->
@endsection