
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
                                @can('create_education', $educations)
                                <div class="row mb-4">
                                    <div class="col-6"></div>
                                    <div class="col-6 text-end">
                                        <a href="{{ route('education.create') }}" class="btn btn-primary btn-sm">
                                            New Education
                                        </a>
                                    </div>
                                </div>
                                @endcan
                                <div class="row">
                                    <div class="col-10 text-start">
                                        <div class="col-1">
                                            <form method="GET" action="{{ route('education.index') }}">
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
                                        <form method="GET" action="{{ route('education.search') }}">
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
                                                <th>School Logo</th>
                                                <th>Degree</th>
                                                <th>Major</th>
                                                <th>School Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($educations as $education)
                                            <tr>
                                                <td class="text-bold-500">{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ asset('/' . $education->school_logo) }}" class="rounded-3" style="width: 100px; height: 100px; object-fit: cover;">
                                                </td>
                                                <td class="text-bold-500">{{ $education->degree }}</td>
                                                <td class="text-bold-500">{{ $education->major }}</td>
                                                <td class="text-bold-500">{{ $education->school_name }}</td>
                                                <td>
                                                    <div style="display: flex; gap: 5px;">
                                                        @can('edit_education', $educations)
                                                        <a href="{{ route('education.edit', $education->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                                        @endcan
                                                        @can('destroy_education', $educations)
                                                        <form method="POST" action="{{ route('education.destroy', $education->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
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
                                        {{ $educations->appends(['limit' => $perPage, 'q' => $q])->links() }}
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