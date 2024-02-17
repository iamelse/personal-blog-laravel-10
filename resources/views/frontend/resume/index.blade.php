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
                            My Resume
                        </h1>
                    </section>

                    <section class="col-lg-12 pb-2">
                    
                        <h5 class="text l-text-dark fw-bold my-3">Experience</h5>
    
                        @forelse ($experiences as $experience)
                            <div class="row mb-2">
                                <div class="col-1">
                                    <div class="l-circle-container l-card-border-color shadow-sm mb-2">
                                        <div class="l-circle-content">
                                            <img style="width: {{ $experience->company_logo_size }}rem;" src="{{ asset('/' . $experience->company_logo) }}" alt="">
                                            <!-- <i class='bx bxs-folder-open'></i> -->
                                        </div>
                                    </div>
                                </div>
        
                                <div class="col ps-4">
                                    <span class="date-list-card text-uppercase">
                                        {{ \Carbon\Carbon::parse($experience->start_date)->format('M d, Y') }}
                                        . 
                                        {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('M d, Y') : 'PRESENT' }}
                                    </span>
                                    <h6 class="l-text-dark fw-bold mt-2">{{ $experience->position_name }}</h6>
                                    <h6 class="l-text-dark">{{ $experience->company_name }}</h6>
                                    <p class="l-card-text">
                                        {{ $experience->desc }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="l-card-text text-center">
                                No Data
                            </p>
                        @endforelse
    
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
@endsection