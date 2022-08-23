@extends("layouts.app")
@section("title") Add Category @stop
@section("head")
<link rel="stylesheet" href="{{ asset("css/creator.css") }}">
@endsection
@section("content")
<section class="post-create-container">
    <div class="post-create-content">
        <x-breadcrumb>
            <h5 class="back-route"><a href="{{ route("home") }}">Dashboard</a></h5>
            <i class="fas fa-chevron-right"></i>
            <h5 class="back-route"><a href="{{ route("article-category.create") }}">All Categories</a></h5>
           <i class="fas fa-chevron-right"></i>
           <h5 class="current-route">Edit Category</h5>
        </x-breadcrumb>
        <div class="post-create-card">
            <div class="header">
                <h4>Edit Category</h4>
            </div>
            <div class="post-create-card-body">
                <form action="{{ route("update.category",$category->slug) }}" method="post" class="post-create-form">
                    @csrf
                    @method("put")
                    <x-form.form-item for="name" label="Category Title" type="text" title="name" value="{{$category->name}}"  />
                    <x-form.form-item for="slug" label="Category Slug" type="text" title="slug" value="{{ $category->slug }}"  />
                      <div class="post-create-item">
                        <label for="exampleColorInput" class="form-label">Color picker</label>
                        <input type="color" name="color" class="form-control form-control-color" id="exampleColorInput" value="{{ old("color",$category->color) }}" title="Choose your color">
                      </div>
                      <div class="post-create-item post-create-submit">
                        <button class="upload-btn" type="submit">Update</button>
                      </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
