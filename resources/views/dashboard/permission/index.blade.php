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
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6"></div>
                                    <div class="col-6 text-end">
                                        <a href="{{ route('permission.create') }}" class="btn btn-primary btn-sm">
                                            New Permission
                                        </a>
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
                                                <th>Permission Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($permissions as $permission)
                                            <tr>
                                                <td class="text-bold-500">{{ $loop->iteration }}</td>
                                                <td class="text-bold-500">{{ $permission->name }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td class="text-center" colspan="3">No Data</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
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