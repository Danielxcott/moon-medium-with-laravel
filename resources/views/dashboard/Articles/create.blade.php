@extends("layouts.app")
@section("title") Create post @stop
@section("head")
<link rel="stylesheet" href="{{ asset("css/creator.css") }}">
<link rel="stylesheet" href="{{ asset("summernote/summernote.min.css") }}">
<link rel="stylesheet" href="{{ asset("summernote/summernote-lite.min.css") }}">
@endsection
@section("content")
<section class="post-create-container">
    <div class="post-create-content">
       <x-breadcrumb >
        <h5 class="back-route"><a href="{{ route("home") }}">Dashboard</a></h5>
        <i class="fas fa-chevron-right"></i>
        <h5 class="current-route">Create a post</h5>
       </x-breadcrumb>
        <div class="post-create-card">
            <x-form.form-header link="{{ route('article.index') }}" title="Add post" btn_name="All Posts" />
            <div class="post-create-card-body">
                <form action="{{ route("article.store") }}" method="POST" class="post-create-form" enctype="multipart/form-data">
                    @csrf
                      <x-form.form-item for="title" label="Post Title" type="text" title="title" />
                      <x-form.form-item for="slug" label="Post Slug" type="text" title="slug" />
                      <x-form.form-textarea for="description" label="Description" title="description" />
                      <x-form.form-textarea for="excerpt" label="Excerpt" title="excerpt" />
                      <x-form.form-item for="thumbnail" label="Thumbnail" type="file" title="thumbnail" />
                      <div class="post-create-item">
                        <label for="image">Image</label>
                        <input type="file" multiple class="form-control @error("images.*")
                            is-invalid
                        @enderror " name="images[]" id="image">
                        @error("images.*")
                            <div class="invalid-feedback">
                                <p class="mb-0">{{ $message }}</p>
                            </div>
                        @enderror
                      </div>
                      <x-form.form-category for="category" title="category" label="Category" :categories="$categories" />
                      <div class="post-create-item post-create-submit">
                        <button class="upload-btn" type="submit">Upload</button>
                      </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@push("script")
<script src="{{ asset("summernote/summernote-lite.min.js") }}"></script>
<script src="{{ asset("js/sidebar.js") }}"></script>
<script>
    $('#description').summernote({
        toolbar: [
            ['style', ['style']],
            ['fontsize', ['fontsize']],
            ['insert', ['picture','video','link', 'hr']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['height', ['height']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']]
            ]
    });
  </script>
@endpush
