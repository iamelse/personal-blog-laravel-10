
@extends('template.main')

@section('content')
<div id="main-content">
    <div class="page-heading">
        
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Dashboard</h3>
                    <p class="text-subtitle text-muted">Navbar will appear on the top of the page.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Layout Vertical Navbar</li>
                    </ol>
                    </nav>
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
                                <div class="row mb-4">
                                    <div class="col-6"></div>
                                    <div class="col-6 text-end">
                                        <a href="{{ route('backend.project.create') }}" class="btn btn-primary btn-sm">
                                            New Project
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-10 text-start">
                                        <div class="row">
                                            <div class="col-1">
                                                <form method="GET" action="{{ route('backend.project.index') }}">
                                                    <label for="limit" class="fw-bold">Limit:</label>
                                                    <select name="limit" id="limit" class="form-select col-2" onchange="this.form.submit()">
                                                        <option value="10" {{ request('limit') == 10 ? 'selected' : '' }}>10</option>
                                                        <option value="25" {{ request('limit') == 25 ? 'selected' : '' }}>25</option>
                                                        <option value="50" {{ request('limit') == 50 ? 'selected' : '' }}>50</option>
                                                        <option value="100" {{ request('limit') == 100 ? 'selected' : '' }}>100</option>
                                                    </select>
                                                </form>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="col-2">
                                        <form method="GET" action="{{ route('backend.project.search') }}">
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
                                                <th>Project Title</th>
                                                <th>Slug</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($projects as $project)
                                            <tr>
                                                <td class="text-bold-500">{{ $loop->iteration }}</td>
                                                <td class="text-bold-500">{{ $project->title ?? '' }}</td>
                                                <td class="text-bold-500">{{ $project->slug ?? '' }}</td>
                                                <td>
                                                    <div style="display: flex; gap: 5px;">
                                                        <a href="{{ route('backend.project.edit', $project->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                                        <form method="POST" action="{{ route('backend.project.destroy', $project->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                        </form>
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
                                        {{ $projects->appends(['limit' => $perPage, 'q' => $q])->links() }}
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
</div>
@endsection

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