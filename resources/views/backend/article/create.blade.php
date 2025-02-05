@extends('template.main')

@section('content')
    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Create a New Post</h3>
                        <p class="text-subtitle text-muted">Craft your content, categorize it, and schedule it for publication.</p>
                    </div>
                </div>
            </div>            
        </div>

        <div class="row match-height">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-content">
                        
                        <!-- Form Start -->
                        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                            @csrf
        
                            <!-- Post Section -->
                            <div class="card-header bg-light text-dark fw-bold rounded-top">
                                Post Details
                            </div>
                            <div class="card-body">
                                <p class="text-muted mt-3" style="font-size: 0.95rem;">
                                    Complete the fields below to ensure your post is properly formatted, categorized, and scheduled. This helps enhance user engagement and ensures better discoverability in search results.
                                </p>
                                
                                <!-- Cover Image -->
                                <div class="form-group mb-3 mandatory">
                                    <label class="form-label" for="cover">Cover Image</label>
                                    <input type="file" class="form-control @error('cover') is-invalid @enderror" name="cover" id="cover">
                                    @error('cover')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
        
                                <!-- Title -->
                                <div class="form-group mandatory mb-3">
                                    <label class="form-label" for="title">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Enter post title" name="title" id="title" value="{{ old('title') }}"/>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
        
                                <!-- Slug -->
                                <div class="form-group mandatory mb-3">
                                    <label class="form-label" for="slug">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" placeholder="Post URL Slug" name="slug" id="slug" value="{{ old('slug') }}" readonly/>
                                    <small class="form-text text-muted">* The slug is automatically generated. Press tab or click outside the field to generate it.</small>
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
        
                                <!-- Categories -->
                                <div class="form-group mb-3 mandatory">
                                    <label class="form-label" for="selectPostCategory">Categories</label>
                                    <select class="form-select @error('post_category_id') is-invalid @enderror" name="post_category_id" id="selectPostCategory">
                                        <option value="" selected>-- Select Categories --</option>
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
        
                                <!-- Content -->
                                <div class="form-group mandatory mb-3">
                                    <label class="form-label" for="content">Content</label>
                                    <textarea id="editor" class="form-control @error('body') is-invalid @enderror" name="body" rows="10" placeholder="Write your post content here...">{{ old('body') }}</textarea>
                                    @error('body')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Post Status -->
                                <div class="form-group mb-3 mandatory">
                                    <label class="form-label" for="selectPostStatus">Post Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" name="status" id="selectPostStatus">
                                        <option value="" selected>-- Select Status --</option>
                                        @foreach ($postStatuses as $key => $label)
                                            <option value="{{ $key }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
        
                                <!-- Post Schedule (Hidden by Default) -->
                                <div class="form-group mb-3" id="postScheduleForm" style="display: none;">
                                    <label class="form-label" for="published_at">Post Schedule</label>
                                    <input type="text" class="form-control @error('published_at') is-invalid @enderror" 
                                        placeholder="Select date and time" name="published_at" id="published_at" 
                                        value="{{ old('published_at') }}"/>
                                    <small class="form-text text-muted">If you want the post to be published immediately, leave this field empty.</small>
                                    @error('published_at')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
        
                            <!-- SEO Section -->
                            <div class="card-header bg-light text-dark fw-bold rounded-top">
                                Search Engine Optimization
                            </div>
                            <div class="card-body">
                                <p class="text-muted mt-3" style="font-size: 0.95rem;">
                                    Fill in the fields below to optimize your post for search engines and improve its visibility.
                                </p>
        
                                <!-- Meta Title -->
                                <div class="form-group mb-3">
                                    <label class="form-label" for="seo_title">Meta Title</label>
                                    <input type="text" class="form-control @error('seo_title') is-invalid @enderror" placeholder="Meta Title" name="seo_title" id="seo_title" value="{{ old('seo_title') }}"/>
                                    <small class="form-text text-muted">The Meta Title is shown in the browser tab and search engine results. Keep it under 60 characters for optimal display.</small>
                                    @error('seo_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Meta Description -->
                                <div class="form-group mb-3">
                                    <label class="form-label" for="seo_description">Meta Description</label>
                                    <textarea class="form-control @error('seo_description') is-invalid @enderror" placeholder="Meta Description" name="seo_description" id="seo_description" rows="4">{{ old('seo_description') }}</textarea>
                                    <small class="form-text text-muted">Write a concise and compelling description under 160 characters. It appears under the title in search results.</small>
                                    @error('seo_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Meta Keywords -->
                                <div class="form-group mb-3">
                                    <label class="form-label" for="seo_keywords">Meta Keywords</label>
                                    <input type="text" class="form-control @error('seo_keywords') is-invalid @enderror" placeholder="Meta Keywords" name="seo_keywords" id="seo_keywords" value="{{ old('seo_keywords') }}"/>
                                    <small class="form-text text-muted">Use keywords that are relevant to the post content, separated by commas (e.g., Laravel, web development).</small>
                                    @error('seo_keywords')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- SEO Tips -->
                                <div class="alert alert-info mt-4">
                                    <strong>SEO Tips:</strong> 
                                    <ul>
                                        <li>Write unique Meta Titles and Descriptions for better visibility.</li>
                                        <li>Use keywords naturally in the post content.</li>
                                        <li>Keep Meta Titles and Descriptions within optimal length limits.</li>
                                    </ul>
                                </div>
                            </div>
        
                            <!-- Submit Buttons -->
                            <div class="row mx-2 mb-3">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-sm btn-primary me-1 mb-1">Save Post</button>
                                    <a href="{{ route('post.index') }}" class="btn btn-sm btn-secondary me-1 mb-1">Cancel</a>
                                </div>
                            </div>
                        </form>
                        <!-- Form End -->
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
                },
                li: function (el) {
                    el.addClass('l-text-p');
                },
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const statusSelect = document.getElementById("selectPostStatus");
        const scheduleForm = document.getElementById("postScheduleForm");

        function toggleScheduleForm() {
            if (statusSelect.value === "scheduled") {
                scheduleForm.style.display = "block";
            } else {
                scheduleForm.style.display = "none";
            }
        }

        // Trigger on change
        statusSelect.addEventListener("change", toggleScheduleForm);

        // Ensure correct state on page load (for edit scenarios)
        toggleScheduleForm();
    });
</script>
@endpush