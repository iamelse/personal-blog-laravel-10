
@extends('template.main')

@section('content')
<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Post Categories</h3>
                    <p class="text-subtitle text-muted">View and manage your post categories.</p>
                </div>
            </div>
        </div>        
    </div>

    <!-- Basic Tables start -->
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-header">
                            @can('create_post_categories', $postCategories)
                            <div class="row mb-4">
                                <div class="col-6"></div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('post.category.create') }}" class="btn btn-primary btn-sm">
                                        New Category
                                    </a>
                                </div>
                            </div>
                            @endcan
                            <div class="row">
                                <div class="col-10 text-start">
                                    <div class="col-1">
                                        <form method="GET" action="{{ route('post.category.index') }}">
                                            <label for="limit" class="fw-bold">Limit:</label>
                                            <select name="limit" class="form-select col-2" onchange="this.form.submit()">
                                                <option value="10" {{ request('limit') == 10 ? 'selected' : '' }}>10</option>
                                                <option value="25" {{ request('limit') == 25 ? 'selected' : '' }}>25</option>
                                                <option value="50" {{ request('limit') == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ request('limit') == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <form method="GET" action="{{ route('post.category.search') }}">
                                        <div class="form-group mandatory">
                                            <label for="search" class="fw-bold">Search:</label>
                                            <input
                                                type="text"
                                                class="form-control @error('q') is-invalid @enderror"
                                                placeholder="Search"
                                                name="q"
                                                value="{{ request('q') }}"
                                            />
                                            @error('q')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <table class="table table-lg">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Post Category Name</th>
                                            <th>Slug</th>
                                            @if (auth()->user()->roles[0]->name === "Master")
                                                <th>Display on Homepage</th>
                                            @endif
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($postCategories as $postCategory)
                                        <tr>
                                            <td class="text-bold-500">{{ $loop->iteration }}</td>
                                            <td class="text-bold-500">{{ $postCategory->name }}</td>
                                            <td class="text-bold-500">{{ $postCategory->slug }}</td>
                                            @if (auth()->user()->roles[0]->name === "Master")
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="true" name="isChecked_{{ $postCategory->id }}" id="showInHomepageCheckbox_{{ $postCategory->id }}" data-category-id="{{ $postCategory->id }}" {{ $postCategory->show_in_homepage ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="showInHomepageCheckbox_{{ $postCategory->id }}">
                                                        Display on Homepage
                                                    </label>
                                                </div>
                                            </td>
                                            @endif                                                                                                
                                            <td>
                                                <div style="display: flex; gap: 5px;">
                                                    @can('edit_post_categories', $postCategory)
                                                    <a href="{{ route('post.category.edit', $postCategory->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                                    @endcan
                                                    @can('destroy_post_categories', $postCategory)
                                                    <form method="POST" action="{{ route('post.category.destroy', $postCategory->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" id="delete-btn">Delete</button>
                                                    </form>
                                                    @endcan
                                                </div>
                                            </td>                                                
                                        </tr>
                                        @empty
                                        <tr>
                                            <td class="text-center" colspan="4">No Data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination links -->
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    {{ $postCategories->appends(['limit' => request('limit'), 'q' => request('q')])->links() }}
                                </div>
                            </div>                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>        
    <!-- Basic Tables end -->
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
        const deleteButtons = document.querySelectorAll('#delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const form = this.closest('form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        confirmButton: 'btn btn-primary mx-1',
                        cancelButton: 'btn btn-danger mx-1'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        @if($errors->any())
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Oops, something went wrong.',
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        function enforceConstraints() {
            var checkedCount = $('.form-check-input:checked').length;

            $('.form-check-input').each(function() {
                var isChecked = $(this).is(':checked');
                $(this).prop('disabled', checkedCount >= 4 && !isChecked || checkedCount === 1 && isChecked);
            });
        }

        $('.form-check-input').change(function(){
            var categoryId = $(this).data('category-id');
            var isChecked = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: '{{ route("api.post.category.updateVisibility") }}',
                type: 'PUT',
                data: {
                    categoryId: categoryId,
                    isChecked: isChecked
                },
                success: function(){
                    console.log('Visibility updated successfully');
                },
                error: function(xhr, status, error){
                    console.error('Error updating visibility:', error);
                }
            });

            enforceConstraints();
        });

        enforceConstraints();
    });
</script>
@endpush
