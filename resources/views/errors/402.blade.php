@extends('layouts.error')

@section('title', __('Payment Required'))
@section('code', '402')
@section('message', __('Payment Required'))
@section('desc_message', "This action requires a payment. Please complete your payment to proceed.")

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen px-6 text-center bg-white dark:bg-gray-900">
        <!-- Error Code -->
        <h1 class="text-9xl font-extrabold text-purple-500 dark:text-purple-400">
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