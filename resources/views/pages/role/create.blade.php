@php
    use App\Enums\PermissionEnum;
@endphp

@extends('layouts.app')

@section('content')
<!-- ===== Main Content Start ===== -->
<main>
    <div class="p-4 mx-auto max-w-screen-2xl md:p-6">

        <!-- Header Section -->
        <div class="flex px-6 flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Create a Role</h1>
                <p class="text-gray-600 dark:text-gray-400">Define and manage user roles with permissions.</p>
            </div>
        </div>

        <!-- Form Section -->
        <div class="border-gray-100 p-5 dark:border-gray-800 sm:p-6">
            <div class="rounded-2xl px-6 pb-8 pt-4 border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <form action="{{ route('be.role.and.permission.store') }}" method="POST" x-data="{ name: '', slug: '' }">
                    @csrf
                    
                    <!-- Role Name -->
                    <div class="mt-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Role Name <span class="text-error-500">*</span>
                        </label>
                        <div x-data="{ hasError: {{ session('errors') && session('errors')->has('name') ? 'true' : 'false' }} }">
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                x-model="name" 
                                @input="slug = name.toLowerCase().trim().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '')"
                                placeholder="Enter role name"
                                :class="hasError ? 'border-red-500 dark:border-red-500' : 'border-gray-300 dark:border-gray-700 focus:border-brand-300 dark:focus:border-brand-800'"
                                class="h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:outline-none focus:ring focus:ring-brand-500/10 dark:bg-dark-900 dark:text-white/90 dark:placeholder:text-white/30"
                                required>
                            <span class="text-xs mt-1 font-medium text-red-500 dark:text-red-500" x-show="hasError">
                                @error('name') * {{ $message }} @enderror
                            </span>
                        </div>
                    </div>
    
                    <!-- Slug (Read-only) -->
                    <div class="mt-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Slug <span class="text-error-500">*</span>
                        </label>
                        <div x-data="{ hasError: {{ session('errors') && session('errors')->has('slug') ? 'true' : 'false' }} }">
                            <input 
                                type="text" 
                                id="slug" 
                                name="slug" 
                                x-model="slug"
                                placeholder="Slug is auto generated"
                                :class="hasError ? 'border-red-500 dark:border-red-500' : 'border-gray-300 dark:border-gray-700 focus:border-brand-300 dark:focus:border-brand-800'"
                                class="h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:outline-none focus:ring focus:ring-brand-500/10 dark:bg-dark-900 dark:text-white/90 dark:placeholder:text-white/30"
                                readonly>
                            <span class="text-xs mt-1 font-medium text-red-500 dark:text-red-500" x-show="hasError">
                                @error('slug') * {{ $message }} @enderror
                            </span>
                        </div>
                    </div>
    
                    <!-- Submit Button -->
                    <div class="flex justify-end mt-6">
                        <button type="submit" 
                            class="px-6 py-2.5 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 
                            focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Create Role
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<!-- ===== Main Content End ===== -->
@endsection