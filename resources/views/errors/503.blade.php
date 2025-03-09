@extends('layouts.error')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable'))
@section('desc_message', "Our site is currently undergoing maintenance. Please check back later.")

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen px-6 text-center bg-white dark:bg-gray-900">
        <h1 class="text-9xl font-extrabold text-purple-600 dark:text-purple-400">
            @yield('code')
        </h1>

        <p class="text-3xl sm:text-4xl font-bold text-gray-800 dark:text-gray-200 mt-6">
            @yield('message')
        </p>

        <p class="text-lg sm:text-xl text-gray-600 dark:text-gray-400 mt-4 max-w-lg">
            @yield('desc_message')
        </p>
    </div>
@endsection
