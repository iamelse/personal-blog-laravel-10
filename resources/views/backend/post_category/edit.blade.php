@extends('template.main')

@section('content')
    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <h3>Edit Category</h3>
            </div>
        </div>

        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" action="{{ route('post.category.update', $postCategory->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group mandatory mb-3">
                                    <label class="form-label">Category Name</label>
                                    <input
                                        type="text"
                                        class="form-control @error('category_name') is-invalid @enderror"
                                        placeholder="Category Name"
                                        name="category_name"
                                        value="{{ old('category_name', $postCategory->name) }}"
                                    />
                                    @error('category_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                        <a href="{{ route('post.category.index') }}" class="btn btn-light-secondary me-1 mb-1">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection