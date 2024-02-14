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
                            <form method="POST" action="{{ route('user.update', $user->id) }}">
                                @csrf
                                @method('PUT') {{-- Use the PUT method for updating --}}
                                
                                <div class="form-group">
                                    <label for="role_id">Role</label>
                                    <select class="form-control @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required>
                                        <option value="" selected>Choose role...</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>                                    
                            
                                <div class="form-group mandatory mb-3">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            
                                <div class="form-group mandatory mb-3">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            
                                <div class="form-group mandatory mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            
                                <div class="form-group mb-3">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                        <a href="{{ route('user.index') }}" class="btn btn-light-secondary me-1 mb-1">Cancel</a>
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