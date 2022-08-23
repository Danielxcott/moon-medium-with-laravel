@extends("layouts.app")
@section("title") Edit Article @stop
@section("head")
<link rel="stylesheet" href="{{ asset("css/creator.css") }}">
<link rel="stylesheet" href="{{ asset("summernote/summernote.min.css") }}">
<link rel="stylesheet" href="{{ asset("summernote/summernote-lite.min.css") }}">
<style>
    .images-gallery{
        padding: 0 2rem
    }
    .gallery-del{
        right: 11px;
    }
</style>
@endsection
@section("content")
<section class="post-create-container">
    <div class="post-create-content">
       <x-breadcrumb >
        <h5 class="back-route"><a href="{{ route("home") }}">Dashboard</a></h5>
        <i class="fas fa-chevron-right"></i>
        <h5 class="back-route"><a href="{{ route("article.index") }}">All posts</a></h5>
        <i class="fas fa-chevron-right"></i>
        <h5 class="current-route">Edit a post</h5>
       </x-breadcrumb>
        <div class="post-create-card">
            <x-form.form-header link="{{ route('article.index') }}" title="Edit post" btn_name="All Posts" />
            <div class="post-create-card-body">
                <form action="{{ route("update.article",$article->slug) }}" method="POST" class="post-create-form" enctype="multipart/form-data">
                    @method("put")
                    @csrf
                      <x-form.form-item for="title" label="Post Title" type="text" title="title" value="{{ $article->title }}" />
                      <x-form.form-item for="slug" label="Post Slug" type="text" title="slug" value="{{ $article->slug }}" />
                        @php
                            $decode = html_entity_decode($article->description,ENT_QUOTES);
                        @endphp
                      <x-form.form-textarea for="description" label="Description" title="description" value="{!! $decode !!}" />
                      <x-form.form-textarea for="excerpt" label="Excerpt" title="excerpt" value="{!! $article->excerpt !!}" />
                      <x-form.form-item for="thumbnail" label="Thumbnail" type="file" title="thumbnail" />
                      <x-form.form-category for="category" title="category" label="Category" :categories="$categories" value="{{ $article->category_id }}" />
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
                      <div class="post-create-item post-create-submit">
                        <button class="upload-btn" type="submit">Update</button>
                      </div>
                      <div class="d-flex mt-3 images-gallery">
                        @foreach ($article->photos as $photo )
                      <div class="position-relative me-2 image_file">
                        <input type="hidden" name="img_id" id="img_id" value="{{ $photo->id }}">
                        <img src="{{ asset("storage/article_images/".$photo->images) }}" height="60px" alt="{{ $photo->images }}" class="rounded">
                        <form class="d-inline-block">
                            <button type="button" class="border border-0 bg-transparent gallery-del fs-2 position-absolute bottom-0"><i class="fas fa-trash text-danger"></i></button>
                        </form>
                      </div>
                      @endforeach
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
    let url = "{{ route('delete.article.images') }}"
    $(".post-create-form").delegate(".gallery-del","click",function(){
        let imgId = $(this).closest(".image_file").find("#img_id").val();
        $.post(url,{
        img_id : imgId,
        _token : "{{ csrf_token() }}", 
    }).done(function(data){
        $(".post-create-form").load(location.href+" .post-create-form");
        console.log(data);
    })
    })
</script>
@endpush
