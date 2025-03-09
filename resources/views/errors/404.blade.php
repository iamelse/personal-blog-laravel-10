@extends('layouts.error')

@section('title', __('Page Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
@section('desc_message', "Oops! The page you're looking for doesn't exist or may have been moved.")

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen px-6 text-center bg-white dark:bg-gray-900">
        <!-- Error Code -->
        <h1 class="text-9xl font-extrabold text-blue-600 dark:text-blue-400">
            @yield('code')
        </h1>

        <!-- Error Message -->
        <p class="text-3xl sm:text-4xl font-bold text-gray-800 dark:text-gray-200 mt-6">
            @yield('message')
        </p>

        <!-- Description Message -->
        <p class="text-lg sm:text-xl text-gray-600 dark:text-gray-400 mt-4 max-w-lg">
            @yield('desc_message')
        </p>
    </div>
@endsection