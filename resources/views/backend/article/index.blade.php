
@extends('template.main')

@section('content')
<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Posts</h3>
                    <p class="text-subtitle text-muted">View and manage all your posts.</p>
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
                            <div class="row">
                                <div class="d-flex justify-content-end mb-4">
                                    @can('create_posts', $posts)
                                        <a href="{{ route('post.create') }}" class="btn btn-primary btn-sm me-2">
                                            New Post
                                        </a>
                                    @endcan
                            
                                    @can('mass_destroy_posts', $posts)
                                        <button type="submit" class="btn btn-danger btn-sm" id="deleteSelectedBtn" onclick="submitMassDestroy()" disabled>Delete Selected</button>
                                    @endcan
                                </div>
                            </div>                            
                            <div class="row">
                                <div class="col-10 text-start">
                                    <div class="row">
                                        <div class="col-1">
                                            <form method="GET" action="{{ route('post.index') }}">
                                                <label for="limit" class="fw-bold">Limit:</label>
                                                <select name="limit" id="limit" class="form-select col-2" onchange="this.form.submit()">
                                                    <option value="10" {{ request('limit') == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="25" {{ request('limit') == 25 ? 'selected' : '' }}>25</option>
                                                    <option value="50" {{ request('limit') == 50 ? 'selected' : '' }}>50</option>
                                                    <option value="100" {{ request('limit') == 100 ? 'selected' : '' }}>100</option>
                                                </select>
                                                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                                                <input type="hidden" name="q" value="{{ request('q') }}">
                                                <input type="hidden" name="page" value="{{ request('page') }}">
                                            </form>
                                        </div>
                                        <div class="col-2">
                                            <form method="GET" action="{{ route('post.index') }}">
                                                <label for="category_id" class="fw-bold">Category:</label>
                                                <select name="category_id" id="selectPostCategory" class="form-select col-2" onchange="this.form.submit()">
                                                    <option value="" {{ request('category_id') === null ? 'selected' : '' }}>All Categories</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                </select>
                                                <input type="hidden" name="limit" value="{{ request('limit') }}">
                                                <input type="hidden" name="q" value="{{ request('q') }}">
                                                <input type="hidden" name="page" value="{{ request('page') }}">
                                            </form>
                                        </div>
                                    </div>                                        
                                </div>
                                <div class="col-2">
                                    <form method="GET" action="{{ route('post.index') }}">
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
                                            <input type="hidden" name="limit" value="{{ request('limit') }}">
                                            <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                                            <input type="hidden" name="page" value="{{ request('page') }}">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>                         
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <form id="massDestroyForm" method="POST" action="{{ route('post.mass.destroy') }}">
                                @csrf
                                @method('DELETE')
                                
                                <div class="table-responsive">
                                    <table class="table table-lg">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <input type="checkbox" class="form-check-input" id="selectAll">
                                                </th>
                                                <th>No.</th>
                                                <th>Cover</th>
                                                <th>Category</th>
                                                <th>Author</th>
                                                <th>Post Title</th>
                                                <th>Slug</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($posts as $post)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input" name="ids[]" value="{{ $post->id }}">
                                                </td>
                                                <td class="text-bold-500">{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ getPostCoverImage($post) }}" class="rounded-3" style="width: 100px; height: 100px; object-fit: cover;">
                                                </td>
                                                <td class="text-bold-500">{{ $post->category->name ?? '' }}</td>
                                                <td class="text-bold-500">{{ $post?->author?->name }}</td>
                                                <td class="text-bold-500">{{ $post->title ?? '' }}</td>
                                                <td class="text-bold-500">{{ $post->slug ?? '' }}</td>
                                                @php
                                                    $status = $post->status;
                                                @endphp

                                                <td class="text-bold-500">
                                                    @switch($status)
                                                        @case(\App\Enums\PostStatus::DRAFT->value)
                                                            <span class="badge rounded-pill bg-secondary">Draft</span>
                                                            @break

                                                        @case(\App\Enums\PostStatus::SCHEDULED->value)
                                                            <span class="badge rounded-pill bg-warning text-dark">Scheduled</span>
                                                            @break

                                                        @case(\App\Enums\PostStatus::PUBLISHED->value)
                                                            <span class="badge rounded-pill bg-success">Published</span>
                                                            @break

                                                        @default
                                                            <span class="badge rounded-pill bg-light text-dark">Unknown</span>
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <div style="display: flex; gap: 5px;">
                                                        @can('edit_posts', $post)
                                                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                                        @endcan
                                                        @can('destroy_posts', $post)
                                                        <form method="POST" action="{{ route('post.destroy', $post->id) }}">
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
                                                <td class="text-center" colspan="10">No Data</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <!-- Pagination links -->
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    {{ $posts->appends(['category_id' => request('category_id'), 'limit' => request('limit'), 'q' => request('q')])->links() }}
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
<script>
    const selectAllCheckbox = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('input[name="ids[]"]');
    const deleteButton = document.getElementById('deleteSelectedBtn');

    // Toggle all checkboxes when "Select All" is clicked
    selectAllCheckbox.addEventListener('click', function() {
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        toggleDeleteButton(); // Manually call the function to update the button state
    });

    // Function to toggle the delete button
    function toggleDeleteButton() {
        const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        deleteButton.disabled = !anyChecked;
    }

    // Listen for individual checkbox changes
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', toggleDeleteButton);
    });

    // Initial state of the delete button
    toggleDeleteButton();

    // Mass delete logic
    function submitMassDestroy() {
        const selectedIds = Array.from(checkboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);

        console.log("Selected IDs:", selectedIds);

        if (selectedIds.length === 0) {
            alert("Please select at least one post to delete.");
            return;
        }

        if (confirm("Are you sure you want to delete the selected posts?")) {
            const form = document.getElementById('massDestroyForm');
            form.querySelectorAll('input[name="ids[]"]').forEach(input => input.remove());

            selectedIds.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = id;
                form.appendChild(input);
            });

            form.submit();
        }
    }
</script>
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
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $( '#selectPostCategory' ).select2( {
        theme: 'bootstrap-5',
    } );
</script>
@endpush