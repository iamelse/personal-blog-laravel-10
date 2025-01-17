@extends('template.main')

@section('content')
<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Social Media</h3>
                    <p class="text-subtitle text-muted">Edit the social media link.</p>
                </div>
            </div>
        </div>        
    </div>

    <!-- Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('social.media.update', $socialMedia->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mandatory mb-3">
                                            <label class="form-label">Platform Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Platform Name" name="name" id="name" value="{{ old('name', $socialMedia->name) }}" />
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>   

                                        <div class="form-group mandatory mb-3">
                                            <label class="form-label">Icon</label>
                                            <input type="text" class="form-control @error('icon') is-invalid @enderror" placeholder="Icon" name="icon" id="icon" value="{{ old('icon', $socialMedia->icon) }}" />
                                            @error('icon')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group mandatory mb-3">
                                            <label class="form-label">URL</label>
                                            <input type="url" class="form-control @error('url') is-invalid @enderror" placeholder="URL" name="url" id="url" value="{{ old('url', $socialMedia->url) }}" />
                                            @error('url')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>                                   
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-sm btn-primary me-1 mb-1">Update</button>
                                        <button type="reset" class="btn btn-sm btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic multiple Column Form section end -->
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
        @if($errors->any())
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'There are errors in the form!',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
</script>
@endpush