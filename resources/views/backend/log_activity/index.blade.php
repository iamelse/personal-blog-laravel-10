@extends('template.main')

@section('content')
<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Log Activity</h3>
                    <p class="text-subtitle text-muted">View recent activities by users or system events.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Activity Log</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Log Activity Table start -->
        <section class="section">
            <div class="row" id="log-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form method="GET" action="{{ route('log.activity.index') }}" class="row align-items-end">
                                    <div class="col-md-4 mb-3">
                                        <label for="start_datetime" class="fw-bold">Start Datetime:</label>
                                        <input type="datetime-local" name="start_datetime" id="start_datetime" class="form-control" value="{{ request('start_datetime') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="end_datetime" class="fw-bold">End Datetime:</label>
                                        <input type="datetime-local" name="end_datetime" id="end_datetime" class="form-control" value="{{ request('end_datetime') }}">
                                    </div>
                                    <div class="col-md-4 mb-3 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-2">Apply Filter</button>
                                        <a href="{{ route('log.activity.index') }}" class="btn btn-light">Clear Filter</a>
                                    </div>
                                    <input type="hidden" name="q" value="{{ request('q') }}">
                                    <input type="hidden" name="limit" value="{{ request('limit') }}">
                                    <input type="hidden" name="causer_id" value="{{ request('causer_id') }}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>                                      
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-10 text-start">
                                        <div class="row">
                                            <div class="col-2">
                                                <form method="GET" action="{{ route('log.activity.index') }}">
                                                    <label for="limit" class="fw-bold">Limit:</label>
                                                    <select name="limit" id="limit" class="form-select" onchange="this.form.submit()">
                                                        <option value="10" {{ request('limit') == 10 ? 'selected' : '' }}>10</option>
                                                        <option value="25" {{ request('limit') == 25 ? 'selected' : '' }}>25</option>
                                                        <option value="50" {{ request('limit') == 50 ? 'selected' : '' }}>50</option>
                                                        <option value="100" {{ request('limit') == 100 ? 'selected' : '' }}>100</option>
                                                    </select>
                                                    <input type="hidden" name="q" value="{{ request('q') }}">
                                                    <input type="hidden" name="start_datetime" value="{{ request('start_datetime') }}">
                                                    <input type="hidden" name="end_datetime" value="{{ request('end_datetime') }}">
                                                    <input type="hidden" name="causer_id" value="{{ request('causer_id') }}">
                                                </form>
                                            </div>
                                            <div class="col-2">
                                                <form method="GET" action="{{ route('log.activity.index') }}">
                                                    <label for="causer_id" class="fw-bold">Causer:</label>
                                                    <select name="causer_id" id="selectPostcauser" class="form-select" onchange="this.form.submit()">
                                                        <option value="" {{ request('causer_id') === null ? 'selected' : '' }}>All Causer</option>
                                                        @foreach($causers as $causer)
                                                            <option value="{{ $causer->id }}" {{ request('causer_id') == $causer->id ? 'selected' : '' }}>
                                                                {{ $causer->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="q" value="{{ request('q') }}">
                                                    <input type="hidden" name="start_datetime" value="{{ request('start_datetime') }}">
                                                    <input type="hidden" name="end_datetime" value="{{ request('end_datetime') }}">
                                                </form>
                                            </div>
                                        </div>                                    
                                    </div>
                                    <div class="col-2">
                                        <form method="GET" action="{{ route('log.activity.index') }}">
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
                                                <input type="hidden" name="start_datetime" value="{{ request('start_datetime') }}">
                                                <input type="hidden" name="end_datetime" value="{{ request('end_datetime') }}">
                                                <input type="hidden" name="limit" value="{{ request('limit') }}">
                                                <input type="hidden" name="causer_id" value="{{ request('causer_id') }}">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Table with activity log -->
                                <div class="table-responsive">
                                    <table class="table table-lg">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Description</th>
                                                <th>Causer</th>
                                                <th>Timestamp</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($activities as $index => $activity)
                                            <tr>
                                                <td class="text-bold-500">{{ ($activities->currentPage() - 1) * $activities->perPage() + $index + 1 }}</td>
                                                <td>{{ $activity->description ?? 'No description available' }}</td>
                                                <td>{{ $activity->causer->name ?? 'Unknown/Anonymous' }}</td>
                                                <td>{{ $activity->created_at ? $activity->created_at->format('F j, Y, g:i A') : 'Unknown time' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    @if($activities->isEmpty())
                                        <p class="text-center">No activity logs available.</p>
                                    @endif
                                </div>

                                <!-- Pagination links -->
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        {{ $activities->appends(request()->query())->links() }}
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Log Activity Table end -->
</div>
@endsection