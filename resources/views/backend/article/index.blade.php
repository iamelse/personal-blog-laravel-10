
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
                            @can('create_posts', $posts)
                            <div class="row mb-4">
                                <div class="col-6"></div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('post.create') }}" class="btn btn-primary btn-sm">
                                        New Post
                                    </a>
                                </div>
                            </div>
                            @endcan
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
                            <div class="table-responsive">
                                <table class="table table-lg">
                                    <thead>
                                        <tr>
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
                                            <td class="text-center" colspan="6">No Data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination links -->
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    {{ $posts->appends(['limit' => $perPage, 'q' => $q, 'category_id' => $category_id])->links() }}
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
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $( '#selectPostCategory' ).select2( {
        theme: 'bootstrap-5',
    } );
</script>
@endpush