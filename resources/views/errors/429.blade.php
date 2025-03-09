@extends('layouts.error')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))
@section('desc_message', "You're sending too many requests. Please slow down and try again later.")

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen px-6 text-center bg-white dark:bg-gray-900">
        <!-- Error Code -->
        <h1 class="text-9xl font-extrabold text-yellow-500 dark:text-yellow-400">
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