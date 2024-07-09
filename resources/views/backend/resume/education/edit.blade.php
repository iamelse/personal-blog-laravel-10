@extends('template.main')

@section('content')
    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <h3>Edit Category</h3>
            </div>
        </div>

        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('education.update', $education->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                            
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group mb-3">
                                                    <label for="school_logo" class="form-label">School Logo</label>
                                                    <input type="file" class="form-control @error('school_logo') is-invalid @enderror" id="school_logo" name="school_logo" accept="image/*">
                                                    <small id="schoolLogoHelp" class="form-text text-muted">Upload a school logo (accepted formats: jpg, jpeg, png, gif).</small>
                                                    @error('school_logo')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group mb-3">
                                                    <label for="school_logo_size" class="form-label">Logo Size</label>
                                                    <input type="text" class="form-control @error('school_logo_size') is-invalid @enderror" id="school_logo_size" placeholder="Logo Size" name="school_logo_size" value="{{ old('school_logo_size', $education->school_logo_size) }}">
                                                    @error('school_logo_size')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group mandatory mb-3">
                                                    <label for="school_name" class="form-label">School Name</label>
                                                    <input type="text" class="form-control @error('school_name') is-invalid @enderror" id="school_name" placeholder="School Name" name="school_name" value="{{ old('school_name', $education->school_name) }}">
                                                    @error('school_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                    
                                            <div class="col-6">
                                                <div class="form-group mandatory mb-3">
                                                    <label for="major" class="form-label">Major</label>
                                                    <input type="text" class="form-control @error('major') is-invalid @enderror" id="major" placeholder="Major" name="major" value="{{ old('major', $education->major) }}">
                                                    @error('major')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group mandatory mb-3">
                                                    <label for="degree" class="form-label">Degree</label>
                                                    <input type="text" class="form-control @error('degree') is-invalid @enderror" id="degree" placeholder="Degree" name="degree" value="{{ old('degree', $education->degree) }}">
                                                    @error('degree')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                
                                        <div class="form-group mandatory mb-3">
                                            <label for="desc" class="form-label">Description</label>
                                            <textarea class="form-control @error('desc') is-invalid @enderror" id="desc" placeholder="Description" name="desc" rows="4">{{ old('desc', $education->desc) }}</textarea>
                                            @error('desc')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group mandatory mb-3">
                                                    <label for="start_date" class="form-label">Start Date</label>
                                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', \Carbon\Carbon::parse($education->start_date)->format('F j, Y')) }}">
                                                    @error('start_date')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group mb-3">
                                                    <label for="end_date" class="form-label">End Date</label>
                                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('start_date', \Carbon\Carbon::parse($education->end_date)->format('F j, Y')) }}">
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
                                                    <input class="form-check-input" type="checkbox" name="is_still_work_here" id="isStillWorkHereCheckbox" {{ $education->end_date === null ? 'checked' : '' }}>
                                                    <label class="form-check-label">
                                                        I am still attending school here
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <a href="{{ route('education.index') }}" class="btn btn-light-secondary me-1 mb-1">Cancel</a>
                                    </div>
                                </div>
                            </form>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('isStillWorkHereCheckbox');
        const endDateInput = document.getElementById('end_date');

        endDateInput.disabled = checkbox.checked;

        checkbox.addEventListener('change', function() {
            endDateInput.disabled = this.checked;
        });
    });
</script>
@endpush