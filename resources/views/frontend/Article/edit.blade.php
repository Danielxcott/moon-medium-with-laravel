@extends("layouts.main")
@section("title") Article Create @stop
@php
     $decode = html_entity_decode($article->description,ENT_QUOTES);
@endphp
@section("head")
<link rel="stylesheet" href="{{ asset("summernote/summernote.min.css") }}">
<link rel="stylesheet" href="{{ asset("summernote/summernote-lite.min.css") }}">
<style>
    .invalid-feedback p{
        font-size: 1.2rem;
    }
    .thumbnail-del,.gallery-del{
        left: 11px;
    }
</style>
@endsection
@section("content")
<section class="profile-content create-form-wrapper">
    <div class="create-post">
        <h3 class="create-post-title">Edit your story ...</h3>
        <div class="create-form-wrapper">
            <form action="{{ route("update.farticle",$article->slug) }}" method="POST" class="create-form" enctype="multipart/form-data" id="edit-form">
                @csrf
                @method("PUT")
                <div class="article-create-item"  >
                    <label for="title">Title</label>
                    <input type="text" form="edit-form" id="title" name="title" value="{{ old("title",$article->title) }}" class="form-control @error("title")
                        is-invalid
                    @enderror">
                    @error("title")
                       <div class="invalid-feedback"> 
                            <p class="mb-0">{{ $message }}</p>
                       </div>
                    @enderror
                </div>
                <div class="article-create-item" >
                    <label for="slug" data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-custom-class="custom-tooltip" id="slug"
                    data-bs-title="The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.">
                    Slug
                    </label>
                    <input type="text" form="edit-form" value="{{ old("slug",$article->slug) }}" id="slug" name="slug" class="form-control @error("slug")
                        is-invalid
                    @enderror">
                    @error("slug")
                    <div class="invalid-feedback"> 
                        <p class="mb-0">{{ $message }}</p>
                   </div>
                    @enderror
                </div>
                <div class="article-create-item" >
                    <label for="feature_img">Feature Img</label>
                    <input type="file" form="edit-form" id="feature_img" name="thumbnail" class="form-control @error("thumbnail")
                        is-invalid
                    @enderror"> 
                    @if($article->thumbnail !== "" && $article->thumbnail !== null)
                        <div class=" position-relative me-2 thumbnail-section">
                            <input type="hidden" value="{{ $article->id }}" id="thumbnail_id">
                            <img src="{{ asset("storage/thumbnail/".$article->thumbnail) }}" height="80" alt="">
                            <form class="d-inline-block">
                                <button type="button" class="border border-0 bg-transparent thumbnail-del fs-2 position-absolute bottom-0"><i class="fas fa-trash text-danger"></i></button>
                            </form>
                        </div>
                    @endif
                    @error("thumbnail")
                    <div class="invalid-feedback"> 
                        <p class="mb-0">{{ $message }}</p>
                   </div>
                    @enderror
                </div>
                <div class="article-create-item" >
                    <label for="images">Images</label>
                    <input type="file" form="edit-form" id="images" name="images[]" multiple class="form-control @error("images.*")
                        is-invalid
                    @enderror"> 
                    @if($article->images !== "")
                    <div class="d-flex p-1">
                        @foreach ($article->photos as $photo )
                    <div class=" position-relative me-2 image-section ">
                        <input type="hidden" value="{{ $photo->id }}" id="img_id">
                        <img src="{{ asset("storage/article_images/".$photo->images) }}" height="80" alt="{{ $photo->images }}">
                        <form class="d-inline-block">
                            <button type="button" class="border border-0 bg-transparent gallery-del fs-2 position-absolute bottom-0"><i class="fas fa-trash text-danger"></i></button>
                        </form>
                    </div>
                    @endforeach
                    </div>
                @endif
                    @error("images.*")
                    <div class="invalid-feedback"> 
                        <p class="mb-0">{{ $message }}</p>
                   </div>
                    @enderror
                </div>
                <div class="article-create-item" >
                    <label for="category">Category</label>
                    <select name="category" form="edit-form" id="category" class="form-select @error("category")
                       is-invalid 
                    @enderror">
                        <option value="" disabled selected>Choose a category</option>
                        @foreach ($categories as $category )
                        <option {{ $category->id == old("category",$article->category_id) ? "selected" : "" }} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error("category")
                    <div class="invalid-feedback"> 
                        <p class="mb-0">{{ $message }}</p>
                   </div>
                    @enderror
                </div>
                <div class="article-create-item" >
                    <label for="summer" >Description</label>
                    <textarea name="description" form="edit-form" class="form-control @error("description")
                        is-invalid
                    @enderror" id="summer" cols="30" rows="5"><?php echo $decode ?></textarea>
                    @error("description")
                    <div class="invalid-feedback"> 
                        <p class="mb-0">{{ $message }}</p>
                   </div>
                    @enderror
                </div>
                <div class="article-create-item article-upload-btn" >
                    <button class="upload-article" form="edit-form">Upload</button>
                    <button class="cancel-btn" form="edit-form">
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
    $(".create-form").delegate(".thumbnail-del","click",function(){
        const getId = $(this).closest(".thumbnail-section").find("#thumbnail_id").val();
        const url = "{{ route('remove.thumbnail') }}";
        $.post(url,{
            id:getId,
            _token : "{{ csrf_token() }}",
        }).done(function(data){
            $(".create-form").load(location.href+" .create-form");
        });
    })
    $(".create-form").delegate(".gallery-del","click",function(){
        let imgId = $(this).closest(".image-section").find("#img_id").val();
        let url = "{{ route('delete.article.images') }}"
        $.post(url,{
        img_id : imgId,
        _token : "{{ csrf_token() }}", 
    }).done(function(data){
        $(".create-form").load(location.href+" .create-form");
    })
    })
  </script>
@endpush