@extends('template.main')

@section('content')
<div id="main-content">
    <div class="page-heading"> 
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Roles</h3>
                    <p class="text-subtitle text-muted">View and manage user roles.</p>
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
                                <div class="col-10 text-start">
                                    <div class="col-1">
                                        <form method="GET" action="{{ route('role.index') }}">
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
                                    <form method="GET" action="{{ route('role.search') }}">
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
                                            <th>Role Name</th>
                                            <th>Total Permission</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($roles as $role)
                                        <tr>
                                            <td class="text-bold-500">{{ $loop->iteration }}</td>
                                            <td class="text-bold-500">{{ $role->name }}</td>
                                            <td class="text-bold-500">{{ $role->permissions->count() }}</td>
                                            <td>
                                                <a href="{{ route('role.show', $role->id) }}" class="btn btn-sm btn-outline-primary">Detail</a>
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
                                    {{ $roles->appends(['limit' => $perPage, 'q' => $q])->links() }}
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