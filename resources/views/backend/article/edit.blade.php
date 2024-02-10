@extends('template.main')

@section('content')
    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <h3>Edit Post</h3>
            </div>
        </div>

        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" action="{{ route('post.update', $post->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group mandatory mb-3">
                                    <label class="form-label">Title</label>
                                    <input
                                        type="text"
                                        class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Post Title"
                                        name="title"
                                        value="{{ old('title', $post->title) }}"
                                    />
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mandatory mb-3">
                                    <label class="form-label">Content</label>
                                    <textarea id="editor" class="form-control" name="content" rows="10" cols="50">{{ $post->body }}</textarea>
                                </div>                                

                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                        <a href="{{ route('post.index') }}" class="btn btn-light-secondary me-1 mb-1">Cancel</a>
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
<script>
    CKEDITOR.replace('editor', {
        on: {
            instanceReady: function (event) {
                this.dataProcessor.htmlFilter.addRules({
                    elements: {
                        p: function (el) {
                            el.addClass('l-card-text');
                        }
                    }
                });
            }
        }
    });
</script>

@endpush