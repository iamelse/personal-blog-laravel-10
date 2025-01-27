@extends('template.main')

@section('content')
<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>New Experience</h3>
                    <p class="text-subtitle text-muted">Create a new professional experience details.</p>
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
                            <form class="form" method="POST" action="{{ route('experience.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group mandatory mb-3">
                                                    <label for="company_logo" class="form-label">Company Logo</label>
                                                    <input type="file" class="form-control @error('company_logo') is-invalid @enderror" id="company_logo" name="company_logo" accept="image/*">
                                                    <small id="companyLogoHelp" class="form-text text-muted">Upload a company logo (accepted formats: jpg, jpeg, png, gif).</small>
                                                    @error('company_logo')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group mb-3">
                                                    <label for="company_logo_size" class="form-label">Company Logo Size</label>
                                                    <input type="text" class="form-control @error('company_logo_size') is-invalid @enderror" id="company_logo_size" placeholder="Company Logo Size" name="company_logo_size" value="{{ old('company_logo_size') }}">
                                                    @error('company_logo_size')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group mandatory mb-3">
                                                    <label for="company_name" class="form-label">Company Name</label>
                                                    <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" placeholder="Company Name" name="company_name" value="{{ old('company_name') }}">
                                                    @error('company_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                    
                                            <div class="col-6">
                                                <div class="form-group mandatory mb-3">
                                                    <label for="position_name" class="form-label">Position Name</label>
                                                    <input type="text" class="form-control @error('position_name') is-invalid @enderror" id="position_name" placeholder="Position Name" name="position_name" value="{{ old('position_name') }}">
                                                    @error('position_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                
                                        <div class="form-group mandatory mb-3">
                                            <label for="desc" class="form-label">Description</label> <span class="badge bg-primary">HTML</span>
                                            <textarea class="form-control @error('desc') is-invalid @enderror" id="desc" placeholder="Description" name="desc" rows="4">{{ old('desc') }}</textarea>
                                            @error('desc')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group mandatory mb-3">
                                                    <label for="start_date" class="form-label">Start Date</label>
                                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}">
                                                    @error('start_date')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group mb-3">
                                                    <label for="end_date" class="form-label">End Date</label>
                                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}">
                                                    <small id="endDateHelp" class="form-text text-muted">If you are presently employed here, please leave this section blank.</small>
                                                    @error('end_date')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="is_still_work_here" id="isStillWorkHereCheckbox">
                                                    <label class="form-check-label">
                                                        Im still work here
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-sm btn-primary me-1 mb-1">Submit</button>
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#start_date", {
        enableTime: false,
        dateFormat: "F j, Y",
    });

    flatpickr("#end_date", {
        enableTime: false,
        dateFormat: "F j, Y",
        defaultDate: null
    });
</script>
<script>
    const checkbox = document.getElementById('isStillWorkHereCheckbox');
    const endDateInput = document.getElementById('end_date');

    checkbox.addEventListener('change', function() {
        endDateInput.disabled = this.checked;
    });
</script>
@endpush