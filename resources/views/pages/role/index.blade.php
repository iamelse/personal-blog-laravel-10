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
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Role Management</h1>
            <p class="text-gray-600 dark:text-gray-400">Manage user roles and permissions</p>
        </div>
        @can(PermissionEnum::CREATE_ROLE, $roles)
        <a href="{{ route('be.role.and.permission.create') }}" 
            class="flex items-center gap-2 px-5 py-2.5 text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700">
            <i class="bx bx-plus text-lg"></i> New Role
        </a>
        @endcan
    </div>
    
    <!-- Table Section -->
    <div class="border-gray-100 p-5 dark:border-gray-800 sm:p-6">
        <div class="rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="mb-4 flex flex-col gap-2 px-5 sm:flex-row sm:items-end sm:justify-end sm:px-6">
                
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <form>
                        <div class="relative flex items-center gap-2">
                            <!-- Reset Filter Button -->
                            <a href="{{ route('be.role.and.permission.index') }}"
                                class="text-theme-sm shadow-theme-xs flex h-[42px] items-center gap-2 rounded-lg border border-red-300 bg-white px-4 py-2.5 font-medium text-red-700 hover:bg-red-50 hover:text-red-800 dark:border-red-700 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-white/[0.03] dark:hover:text-red-200">
                                <i class="bx bx-x text-lg"></i>
                                Reset Filter
                            </a>
                            
                            <!-- Filter Modal need to adjust the sort-->
                            <div x-data="{ open: false, selectedField: '{{ request()->query('filter') ? array_key_first(request('filter')) : '' }}' }">                            
                                <!-- Filter Button -->
                                <button @click.prevent="open = true"
                                    class="text-theme-sm shadow-theme-xs flex h-[42px] items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                    <i class="bx bx-filter text-lg"></i>
                                    Filter
                                </button>

                                <!-- Modal -->
                                <div x-cloak x-show="open" @keydown.escape.window="open = false"
                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                    <div @click.away="open = false"
                                        class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-1/2">
                                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Filter Options</h2>

                                        <!-- Form -->
                                        <form method="GET" action="{{ route('be.role.and.permission.index') }}">
                                            <!-- Select Filter Field -->
                                            <div class="mt-4">
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                    Filter Field
                                                </label>
                                                <select x-model="selectedField"
                                                    class="w-full mt-1 px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 focus:ring focus:ring-blue-500">
                                                    <option value="" {{ request()->query('filter') ? '' : 'selected' }}> * </option>
                                                    @foreach ($allowedFilterFields as $field)
                                                        <option value="{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Filter Keyword -->
                                            <div class="mt-4">
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                    Keyword
                                                </label>
                                                <input type="text" x-bind:name="'filter[' + selectedField + ']'" 
                                                    value="{{ request('filter')[array_key_first(request('filter') ?? [])] ?? '' }}"
                                                    class="w-full mt-1 px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 focus:ring focus:ring-blue-500">
                                            </div>


                                            <!-- Sort Field Selection -->
                                            <div class="mt-4">
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                    Sort By
                                                </label>
                                                <select name="sort"
                                                    class="w-full mt-1 px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 focus:ring focus:ring-blue-500">
                                                    @foreach ($allowedSortFields as $field)
                                                        <option value="{{ $field }}" {{ request('sort') === $field ? 'selected' : '' }}>
                                                            {{ ucfirst(str_replace('_', ' ', $field)) }} (Ascending)
                                                        </option>
                                                        <option value="-{{ $field }}" {{ request('sort') === "-$field" ? 'selected' : '' }}>
                                                            {{ ucfirst(str_replace('_', ' ', $field)) }} (Descending)
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Buttons -->
                                            <div class="mt-6 flex justify-end gap-3">
                                                <button type="button" @click="open = false"
                                                    class="px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100">
                                                    Cancel
                                                </button>
                                                <button type="submit"
                                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                                    Apply
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>                    
                </div>
            </div>

            <div class="min-h-[500px] custom-scrollbar max-w-full overflow-x-auto px-5 sm:px-6">
                <table class="min-w-full table-auto" x-data="{ selectAll: false, selected: {} }">
                    <thead class="border-y border-gray-200 dark:border-gray-800 dark:bg-gray-900">
                        <tr class="text-left text-gray-600 dark:text-gray-300 text-sm">
                            <th class="w-10 px-6 py-3">
                                <div @click="selectAll = !selectAll; selected = selectAll ? {{ json_encode(array_fill_keys($roles->pluck('id')->toArray(), true)) }} : {}"
                                    class="flex h-5 w-5 cursor-pointer items-center justify-center rounded-md border-[1.25px] transition-all"
                                    :class="selectAll ? 'border-blue-600 dark:border-blue-600 bg-blue-600 dark:bg-blue-600 text-white' : 
                                                'bg-white dark:bg-gray-900 border-gray-300 dark:border-gray-600 text-transparent'">
                                    <i class="bx bx-check text-lg" :class="selectAll ? 'text-white' : 'text-transparent'"></i>
                                </div>
                            </th>
                            <th class="w-20 px-4 py-3 font-medium">No.</th>
                            <th class="px-4 py-3 font-medium">Name</th>
                            <th class="px-4 py-3 font-medium">Created At</th>
                            <th class="px-4 py-3 font-medium">Updated At</th>
                            <th class="px-4 py-3 font-medium text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800 dark:text-gray-400">
                        @foreach ($roles as $role)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                <td class="w-10 px-6 py-3">
                                    <div @click="selected['{{ $role->id }}'] = !selected['{{ $role->id }}']; 
                                                selectAll = Object.keys(selected).length === {{ $roles->count() }};"
                                        class="flex h-5 w-5 cursor-pointer items-center justify-center rounded-md border transition-all duration-200"
                                        :class="selected['{{ $role->id }}'] ? 'border-blue-600 dark:border-blue-600 bg-blue-600 dark:bg-blue-600 text-white' : 
                                                    'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-transparent'">
                                        <i class="bx bx-check text-lg" :class="selected['{{ $role->id }}'] ? 'text-white' : 'text-transparent'"></i>
                                    </div>
                                </td>
                                <td class="w-20 px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">{{ $role->name }}</td>
                                <td class="px-4 py-3">{{ $role->created_at }}</td>
                                <td class="px-4 py-3">{{ $role->updated_at }}</td>
                                <td class="px-4 py-3 text-center relative">
                                    <div x-cloak x-data="{ openDropDown: false }" class="inline-block">
                                        <button @click="openDropDown = !openDropDown" 
                                            class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
                                            <i class="bx bx-dots-horizontal-rounded text-xl"></i>
                                        </button>
                                        <div x-show="openDropDown" @click.outside="openDropDown = false"
                                            class="absolute right-16 top-8 mt-1 w-40 rounded-lg border border-gray-200 bg-white shadow-lg dark:border-gray-800 dark:bg-gray-900 
                                            z-50 overflow-visible">
                                            <a href="{{ route('be.role.and.permission.edit', $role->slug) }}" class="block w-full px-4 py-2 text-left text-sm text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
                                                Edit
                                            </a>
                                            <a href="{{ route('be.role.and.permission.edit.permissions', $role->slug) }}" class="block w-full px-4 py-2 text-left text-sm text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
                                                Permission
                                            </a>
                                            <!-- Alpine.js State Wrapper -->
                                            <div x-data="{ openRoleDeleteModal: false }">
                                                <!-- Delete Button -->
                                                @can(PermissionEnum::DELETE_ROLE, $roles)
                                                <button @click="openRoleDeleteModal = true" class="block w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-red-100 dark:text-red-400 dark:hover:bg-red-800">
                                                    Delete
                                                </button>
                                                @endcan

                                                <!-- Confirmation Modal -->
                                                <div x-show="openRoleDeleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                                                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-96">
                                                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Confirm Deletion</h2>
                                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 text-center">
                                                            Are you sure you want to delete this? This action cannot be undone.
                                                        </p>

                                                        <!-- Centered Buttons -->
                                                        <div class="flex justify-center space-x-3 mt-6">
                                                            <!-- Cancel Button -->
                                                            <button @click="openRoleDeleteModal = false" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                                                                Cancel
                                                            </button>

                                                            <!-- Delete Form -->
                                                            <form action="{{ route('be.role.and.permission.destroy', $role->slug) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                                                    Yes, Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>                                                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>            
                     
            <div class="{{ !$roles->previousPageUrl() && !$roles->nextPageUrl() ? '' : 'border-t border-gray-200 px-6 py-4 dark:border-gray-800' }}">
                <div class="flex items-center justify-between">
                    <!-- Previous Button -->
                    @if ($roles->previousPageUrl())
                        <a href="{{ $roles->previousPageUrl() }}" class="flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-700 shadow-sm hover:bg-gray-100 hover:text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200 transition">
                            <span class="hidden sm:inline">Previous</span>
                        </a>
                    @endif
            
                    {{ $roles->links() }}
            
                    <!-- Next Button -->
                    @if ($roles->nextPageUrl())
                        <a href="{{ $roles->nextPageUrl() }}" class="flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-700 shadow-sm hover:bg-gray-100 hover:text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200 transition">
                            <span class="hidden sm:inline">Next</span>
                        </a>
                    @endif
                </div>
            </div>                   
            
        </div>
        <!-- Table Five -->
    </div>
   </div>
</main>
<!-- ===== Main Content End ===== -->
@endsection