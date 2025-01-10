@extends('template.main')

@section('content')
    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Edit Post</h3>
                        <p class="text-subtitle text-muted">Update and modify your existing post.</p>
                    </div>
                </div>
            </div>            
        </div>

        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group mb-3">
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
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Post Title" name="title" id="title" value="{{ old('title', $post->title) }}">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mandatory mb-3">
                                    <label class="form-label">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" placeholder="Slug" name="slug" id="slug" value="{{ old('slug', $post->slug) }}" readonly/>
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
                                        <option value="">--Select categories--</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('post_category_id', $post->post_category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('post_category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            
                                <div class="form-group mb-3 mandatory">
                                    <label class="form-label">Post Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" name="status">
                                        <option value="">--Select post status--</option>
                                        @foreach (['published', 'archive', 'draft'] as $status)
                                            <option value="{{ $status }}" {{ old('status', $post->status) == $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>                                
                            
                                <div class="form-group mandatory mb-3">
                                    <label class="form-label">Content</label>
                                    <textarea id="editor" class="form-control @error('content') is-invalid @enderror" name="content" rows="10" cols="50">{{ old('content', $post->body) }}</textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" class="form-control @error('seo_title') is-invalid @enderror" placeholder="Meta Title" name="seo_title" value="{{ old('seo_title', $post->seo->seo_title ?? '') }}"/>
                                    <small class="form-text text-muted">* The meta title is what appears in the browser tab and search engine results. If left empty, the post title will be used instead. Keep it under 60 characters for optimal display in search results.</small>
                                    @error('seo_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Meta Description</label>
                                    <textarea class="form-control @error('seo_description') is-invalid @enderror" placeholder="Meta Description" name="seo_description" rows="3">{{ old('seo_description', $post->seo->seo_description ?? '') }}</textarea>
                                    <small class="form-text text-muted">* The meta description appears under the title in search results. Write a compelling description, summarizing the content in under 160 characters. If left empty, the first part of the post content will be used.</small>
                                    @error('seo_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Meta Keywords</label>
                                    <input type="text" class="form-control @error('seo_keywords') is-invalid @enderror" placeholder="Meta Keywords" name="seo_keywords" value="{{ old('seo_keywords', $post->seo->seo_keywords ?? '') }}"/>
                                    <small class="form-text text-muted">* Keywords help search engines understand the content of your post. Separate each keyword with a comma. For example: "SEO, Laravel, web development". Avoid overstuffing, and focus on relevant terms.</small>
                                    @error('seo_keywords')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-sm btn-primary me-1 mb-1">Update</button>
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
<!-- Scripts -->
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