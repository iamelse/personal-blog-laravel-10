@extends('template.main')

@section('content')
    <div id="main-content">
        
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Edit Technical Skill</h3>
                        <p class="text-subtitle text-muted">Update and modify your existing technical skills information.</p>
                    </div>
                </div>
            </div>            
        </div>

        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('skill.technical.update', $technicalSkill->id) }}">
                                @csrf
                                @method('PUT')
                            
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mandatory mb-3">
                                            <label class="form-label">Technical Skill Name</label>
                                            <input type="text" class="form-control @error('technical_skill_name') is-invalid @enderror" placeholder="Technical Skill Name" name="technical_skill_name" value="{{ old('technical_skill_name', $technicalSkill->name) }}" />
                                            @error('technical_skill_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>   
                            
                                        <div class="form-group mandatory mb-3">
                                            <label class="form-label">Level</label>
                                            <select class="form-control @error('level') is-invalid @enderror" name="level">
                                                <option value="" selected>Select level...</option>
                                                <option value="Beginner" {{ old('level', $technicalSkill->level) == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                                <option value="Intermediate" {{ old('level', $technicalSkill->level) == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                                <option value="Advanced" {{ old('level', $technicalSkill->level) == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                                            </select>
                                            @error('level')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>                                                                                                                           
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-sm btn-primary me-1 mb-1">Submit</button>
                                        <a href="{{ route('skill.technical.index') }}" class="btn btn-sm btn-light-secondary me-1 mb-1">Cancel</a>
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
<script>
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    name.addEventListener('change', function() {
        fetch("{{ route('api.post.category.check.slug') }}?name=" + encodeURIComponent(name.value))
            .then(response => response.json())
            .then(data => slug.value = data.slug)
            .catch(error => console.error('Error:', error));
    });
</script>
@endpush