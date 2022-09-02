@extends("layouts.main")
@section("title") Article Create @stop
@section("head")
<link rel="stylesheet" href="{{ asset("summernote/summernote.min.css") }}">
<link rel="stylesheet" href="{{ asset("summernote/summernote-lite.min.css") }}">
<style>
    .invalid-feedback p{
        font-size: 1.2rem;
    }
</style>
@endsection
@section("content")
<section class="profile-content create-form-wrapper">
    <div class="create-post">
        <h3 class="create-post-title">Tell your story ...</h3>
        <div class="create-form-wrapper">
            <form action="{{ route("store.article") }}" method="POST" class="create-form" enctype="multipart/form-data">
                @csrf
                <div class="article-create-item">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" value="{{ old("title") }}" class="form-control @error("title")
                        is-invalid
                    @enderror">
                    @error("title")
                       <div class="invalid-feedback"> 
                            <p class="mb-0">{{ $message }}</p>
                       </div>
                    @enderror
                </div>
                <div class="article-create-item">
                    <label for="slug" data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-custom-class="custom-tooltip" id="slug"
                    data-bs-title="The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.">
                    Slug
                    </label>
                    <input type="text" value="{{ old("slug") }}" id="slug" name="slug" class="form-control @error("slug")
                        is-invalid
                    @enderror">
                    @error("slug")
                    <div class="invalid-feedback"> 
                        <p class="mb-0">{{ $message }}</p>
                   </div>
                    @enderror
                </div>
                <div class="article-create-item">
                    <label for="feature_img">Feature Img</label>
                    <input type="file" id="feature_img" name="thumbnail" class="form-control @error("thumbnail")
                        is-invalid
                    @enderror"> 
                    @error("thumbnail")
                    <div class="invalid-feedback"> 
                        <p class="mb-0">{{ $message }}</p>
                   </div>
                    @enderror
                </div>
                <div class="article-create-item">
                    <label for="images">Images</label>
                    <input type="file" id="images" name="images" class="form-control @error("images")
                        is-invalid
                    @enderror"> 
                    @error("images")
                    <div class="invalid-feedback"> 
                        <p class="mb-0">{{ $message }}</p>
                   </div>
                    @enderror
                </div>
                <div class="article-create-item">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-select @error("category")
                       is-invalid 
                    @enderror">
                        <option value="" disabled selected>Choose a category</option>
                        @foreach ($categories as $category )
                        <option {{ $category->id == old("category") ? "selected" : "" }} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error("category")
                    <div class="invalid-feedback"> 
                        <p class="mb-0">{{ $message }}</p>
                   </div>
                    @enderror
                </div>
                <div class="article-create-item">
                    <label for="summer" >Description</label>
                    <textarea name="description" class="form-control @error("description")
                        is-invalid
                    @enderror" id="summer" cols="30" rows="5"></textarea>
                    @error("description")
                    <div class="invalid-feedback"> 
                        <p class="mb-0">{{ $message }}</p>
                   </div>
                    @enderror
                </div>
                <div class="article-create-item article-upload-btn">
                    <button class="upload-article">Upload</button>
                    <button class="cancel-btn">
                        <a href="{{ route("index.frontend") }}">Cancel</a>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <x-frontend.nav-menu />
</section>
@endsection
@push("script")
<script src="{{ asset("summernote/summernote-lite.min.js") }}"></script>
<script>
    $('#summer').summernote({
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