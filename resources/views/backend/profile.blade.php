@extends('template.main')

@section('content')
<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>My Profile</h3>
                    <p class="text-subtitle text-muted">Manage your personal information.</p>
                </div>                
                <!--
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Layout Vertical Navbar</li>
                    </ol>
                    </nav>
                </div>
                -->
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-3 d-flex flex-column align-items-center">
                        <img src="{{ getUserImageProfilePath(Auth::user()) }}" class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;">
                        
                        @if (Auth::user()->image_profile)
                            <form action="{{ route('profile.destroy.profile.picture') }}" method="POST" class="mt-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete Profile Picture</button>
                            </form>
                        @endif
                    </div>                                            
                    <div class="col-9">
                        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                        
                            <div class="form-group mb-3">
                                <label class="form-label">Image Profile</label>
                                <input type="file" class="form-control @error('image_profile') is-invalid @enderror" name="image_profile">
                                @error('image_profile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3 mandatory">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="form-group mb-3 mandatory">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="form-group mb-3 mandatory">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="row justify-content-end">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>                            
                    </div>
                </div>                    
            </div>
        </div>
    </section>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-3 d-flex justify-content-center">

                    </div>
                    <div class="col-9">
                        <form action="{{ route('profile.update.password') }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3 mandatory">
                                <label for="current_password" class="form-label">Current Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="togglePasswordVisibility('current_password')">
                                            <i class='bx bx-show m-1'></i>
                                        </span>
                                    </div>
                                </div>
                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3 mandatory">
                                <label for="new_password" class="form-label">New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password">
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="togglePasswordVisibility('new_password')">
                                            <i class='bx bx-show m-1'></i>
                                        </span>
                                    </div>
                                </div>
                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3 mandatory">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                                    <div class="input-group-append cursor-pointer">
                                        <span class="input-group-text" onclick="togglePasswordVisibility('new_password_confirmation')">
                                            <i class='bx bx-show m-1'></i>
                                        </span>
                                    </div>
                                </div>
                            </div>                                
                        
                            <div class="row justify-content-end">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>                            
                    </div>
                </div>                    
            </div>
        </div>
    </section>
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

        @if(session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
</script>
@endpush

@push('scripts')
<script>
    function togglePasswordVisibility(inputId) {
        const passwordInput = document.getElementById(inputId);
        const icon = passwordInput.nextElementSibling.querySelector('i.bx');

        passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('bx-show');
        icon.classList.toggle('bx-hide');
    }
</script>
@endpush