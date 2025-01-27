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
                                        {!! $experience->desc !!}
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

                        @forelse ($educations as $education)
                            <div class="row mb-2">
                                <div class="col-1">
                                    <div class="l-circle-container l-card-border-color shadow-sm mb-2">
                                        <div class="l-circle-content">
                                            <img style="width: {{ $education->school_logo_size }}rem;" src="{{ asset('/' . $education->school_logo) }}" alt="">
                                            <!-- <i class='bx bxs-folder-open'></i> -->
                                        </div>
                                    </div>
                                </div>
        
                                <div class="col ps-4">
                                    <span class="date-list-card text-uppercase">
                                        {{ \Carbon\Carbon::parse($education->start_date)->format('M d, Y') }}
                                        . 
                                        {{ $education->end_date ? \Carbon\Carbon::parse($education->end_date)->format('M d, Y') : 'PRESENT' }}
                                    </span>
                                    <h6 class="l-text-dark fw-bold mt-2">{{ $education->degree }}, {{ $education->major }}</h6>
                                    <h6 class="l-text-dark">{{ $education->school_name }}</h6>
                                    <p class="l-card-text">
                                        {{ $education->desc }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="l-card-text text-center">
                                No Data
                            </p>
                        @endforelse
    
                    </section>
    
                </div>
                <!-- End first col -->
    
                <!-- Second col -->
                <div class="col-lg-4">
                    <section class="col-lg-12 mt-3 mb-4">
                        <div class="card l-card-border-color px-3">
                            <div class="card-body">
                                <h5 class="l-card-title l-text-dark">Technical Skills</h5>
                                <div class="mt-3"></div>
                                @forelse ($technicalSkills as $technicalSkill)
                                    <div class="row">
                                        <div class="col text-start">
                                            <p class="l-text-dark fw-bold">
                                                <span class="dash-date-list-card">
                                                    —
                                                    &nbsp;
                                                </span>
                                                {{ $technicalSkill->name }}
                                            </p>
                                        </div>
                                        <div class="col text-end">
                                            <p class="l-card-text">{{ $technicalSkill->level }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="l-card-text text-center">
                                        No Data
                                    </p>
                                @endforelse
                            </div>
                        </div>                  
                    </section>
    
                    <section class="col-lg-12 mb-4">
                        <div class="card l-card-border-color px-3">
                            <div class="card-body">
                                <h5 class="l-card-title l-text-dark">Language</h5>
                                <div class="mt-3"></div>
                                @forelse ($languageSkills as $languageSkill)
                                    <div class="row">
                                        <div class="col text-start">
                                            <p class="l-text-dark fw-bold">
                                                <span class="dash-date-list-card">
                                                    —
                                                    &nbsp;
                                                </span>
                                                {{ $languageSkill->name }}
                                            </p>
                                        </div>
                                        <div class="col text-end">
                                            <p class="l-card-text">{{ $languageSkill->level }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="l-card-text text-center">
                                        No Data
                                    </p>
                                @endforelse
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