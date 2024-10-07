@extends('template.main')

@section('content')
    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <h3>About Me</h3>
                <p class="text-subtitle text-muted">Manage and update the content of your About page here.</p>
            </div>
        </div>

        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" action="{{ route('backend.about.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                            
                                <div class="form-group mandatory mb-3">
                                    <label class="form-label">Content</label>
                                    <textarea id="editor" class="form-control @error('content') is-invalid @enderror" name="content" rows="10" cols="50">{{ old('content', $about->body ?? '') }}</textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            
                                @can('update_about', $about)
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-sm btn-primary me-1 mb-1">Update</button>
                                        <a href="{{ route('backend.about.index') }}" class="btn btn-sm btn-light-secondary me-1 mb-1">Cancel</a>
                                    </div>
                                </div>
                                @endcan
                            </form>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    var options = {
        colorButton_colors: '0ea5e9',
    };
    
    CKEDITOR.replace('editor', options);
    CKEDITOR.instances.editor.on('instanceReady', function (event) {
        this.dataProcessor.htmlFilter.addRules({
            elements: {
                p: function (el) {
                    el.addClass('l-text-p pb-2');
                },
                h1: function (el) {
                    el.addClass('text l-text-dark fw-bold pb-2 display-5');
                },
                h2: headingClass,
                h3: headingClass,
                h4: headingClass,
                h5: headingClass,
                h6: headingClass
            }
        });
    });

    function headingClass(el) {
        el.addClass('text l-text-dark fw-bold my-3');
    }

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