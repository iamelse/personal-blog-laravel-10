@extends('template.main')

@section('content')
    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>New Post</h3>
                        <p class="text-subtitle text-muted">Create a new post with your content.</p>
                    </div>
                </div>
            </div>            
        </div>

        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group mb-3 mandatory">
                                    <label class="form-label">Cover</label>
                                    <input type="file" class="form-control @error('cover') is-invalid @enderror" name="cover">
                                    @error('cover')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mandatory mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Post Title" name="title" id="title" value="{{ old('title') }}"/>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mandatory mb-3">
                                    <label class="form-label">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" placeholder="Slug" name="slug" id="slug" value="{{ old('slug') }}" readonly/>
                                    <small class="form-text text-muted">* The slug is generated automatically. Simply press the tab key or click outside the form to generate it.</small>
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>                                     
                                
                                <div class="form-group mb-3 mandatory">
                                    <label class="form-label">Categories</label>
                                    <select class="form-select @error('post_category_id') is-invalid @enderror" name="post_category_id" id="selectPostCategory">
                                        <option value="" selected>--Select categories--</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('post_category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mandatory mb-3">
                                    <label class="form-label">Content</label>
                                    <textarea id="editor" class="form-control @error('content') is-invalid @enderror" name="content" rows="10" cols="50"></textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>     
                                
                                <div class="form-group mb-3">
                                    <label class="form-label">Post Schedule</label>
                                    <input type="text" class="form-control @error('published_at') is-invalid @enderror" placeholder="Select Date and Time" name="published_at" id="published_at" value="{{ old('published_at') }}"/>
                                    @error('published_at')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-sm btn-primary me-1 mb-1">Submit</button>
                                        <a href="{{ route('post.index') }}" class="btn btn-sm btn-light-secondary me-1 mb-1">Cancel</a>
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

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    flatpickr("#published_at", {
        enableTime: true,
        dateFormat: "Y/m/d H:i",
        minDate: new Date(),
    });
</script>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
        @if($errors->any())
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'There are errors in the form!',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
</script>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $( '#selectPostCategory' ).select2( {
        theme: 'bootstrap-5',
    } );
</script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
        clipboard_handleImages: false
    };
</script>
<script>
    CKEDITOR.replace('editor', options);
    CKEDITOR.instances.editor.on('instanceReady', function (event) {
        this.dataProcessor.htmlFilter.addRules({
            elements: {
                p: function (el) {
                    el.addClass('l-text-p');
                }
            }
        });
    });
</script>
<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function() {
        fetch("{{ route('api.post.check.slug') }}?title=" + encodeURIComponent(title.value))
            .then(response => response.json())
            .then(data => slug.value = data.slug)
            .catch(error => console.error('Error:', error));
    });
</script>
@endpush