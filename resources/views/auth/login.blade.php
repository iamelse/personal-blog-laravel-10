@extends('template.auth')

@section('content')
    <div id="auth">
        <div class="row h-100">
            <!-- Left Column -->
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{ url()->current() }}"><img src="{{ asset('assets/static/images/logo/logo.svg') }}" alt="Logo"></a>
                    </div>
                    <h1 class="display-6 fw-bold">Log in.</h1>
                    <p class="fs-5 text-gray-500 mb-5">Log in with your data that you entered during registration.</p>

                    <form action="{{ route('authenticate') }}" method="POST">
                        @csrf
                        
                        <!-- Email Field -->
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input 
                                type="text" 
                                name="email" 
                                class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                placeholder="Email" 
                                value="{{ old('email') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            <!-- Error Message -->
                            @error('email')
                                <p class="text-danger fw-bold mt-1" style="font-size: 0.85rem;">
                                    * {{ $message }}
                                </p>
                            @enderror
                        </div>
                    
                        <!-- Password Field -->
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input 
                                type="password" 
                                name="password" 
                                class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <!-- Error Message -->
                            @error('password')
                                <p class="text-danger fw-bold mt-1" style="font-size: 0.85rem;">
                                    * {{ $message }}
                                </p>
                            @enderror
                        </div>
                    
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary btn-block btn-md shadow-md mt-3 py-2">
                            Log in
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Column (Empty) -->
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>
@endsection