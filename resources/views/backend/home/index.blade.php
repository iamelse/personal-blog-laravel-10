@extends('template.main')

@section('content')
    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <h3>Home</h3>
            </div>
        </div>

        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" action="{{ route('backend.home.update.image') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')                                

                                <div class="form-group">

                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="radioType" id="imageUploadRadio" value="image" {{ old('radioType', $home->image ? 'image' : '') == 'image' ? 'checked' : '' }}>
                                            <label class="form-check-label mb-1">
                                                Image Upload
                                            </label>
                                        </div>
    
                                        <div id="imageUpload" class="mb-3">
                                            <input type="file" class="form-control" name="imageInput" id="imageInput" value="{{ old('imageInput', $home->image) }}">
                                        </div>
                                    </div>
                                
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="radioType" id="urlRadio" value="url" {{ old('radioType', $home->url ? 'url' : '') == 'url' ? 'checked' : '' }}>
                                            <label class="form-check-label mb-1">
                                                URL Link
                                            </label>
                                        </div>
    
                                        <div id="urlInput" class="mb-3">
                                            <input type="text" class="form-control" name="urlLink" id="urlLink" value="{{ old('urlLink', $home->url) }}" placeholder="Enter URL here">
                                        </div>
                                    </div>    

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radioType" id="removeImageRadio" value="removeImage">
                                        <label class="form-check-label mb-1">
                                            Remove Image
                                        </label>
                                    </div>
                                </div>                            
                            
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                        <a href="{{ route('backend.home.index') }}" class="btn btn-light-secondary me-1 mb-1">Cancel</a>
                                    </div>
                                </div>
                            </form>                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" action="{{ route('backend.home.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group mandatory mb-3">
                                    <label class="form-label">Content</label>
                                    <textarea id="editor" class="form-control @error('content') is-invalid @enderror" name="content" rows="10" cols="50">{{ old('content', $home->body ?? '') }}</textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                        <a href="{{ route('backend.home.index') }}" class="btn btn-light-secondary me-1 mb-1">Cancel</a>
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
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script>
    $(document).ready(function () {
        updateFormVisibility($('input[type=radio][name=radioType]:checked').val());

        $('input[type=radio][name=radioType]').change(function () {
            updateFormVisibility(this.value);
        });

        function updateFormVisibility(value) {
            switch (value) {
                case 'image':
                    $('#imageUpload').show();
                    $('#urlInput').hide();
                    break;
                case 'url':
                    $('#imageUpload').hide();
                    $('#urlInput').show();
                    break;
                default:
                    $('#imageUpload').hide();
                    $('#urlInput').hide();
                    break;
            }
        }
    });
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
    var options = {
        colorButton_colors: '0ea5e9',
    };

    CKEDITOR.config.toolbar = [
        ['Styles', 'Format', 'FontSize', 'TextColor'],
        ['Bold', 'Italic', 'Underline', 'StrikeThrough'],
        ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
    ];

    CKEDITOR.replace('editor', options);
    CKEDITOR.instances.editor.on('instanceReady', function (event) {
        this.dataProcessor.htmlFilter.addRules({
            elements: {
                p: function (el) {
                    el.addClass('l-text-p pb-2 fs-5');
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
</script>
@endpush