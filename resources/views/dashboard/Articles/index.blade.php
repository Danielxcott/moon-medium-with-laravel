@extends("layouts.app")
@section("title") All posts @stop
@section("head")
<link rel="stylesheet" href="{{ asset("css/creator.css") }}">
@endsection
@section("content")
<section class="post-create-container">
    <div class="post-create-content">
        <x-breadcrumb>
            <h5 class="back-route"><a href="{{ route("home") }}">Dashboard</a></h5>
           <i class="fas fa-chevron-right"></i>
           <h5 class="back-route"><a href="{{ route("article.create") }}">Create Post</a></h5>
           <i class="fas fa-chevron-right"></i>
           <h5 class="current-route">All Posts</h5>
        </x-breadcrumb>
        <div class="post-create-card">
            <x-form.form-header link="{{ route('article.create') }}" title="All posts" btn_name="Create Post" />
            <div class="post-create-card-body">
                <table class="table table-bordered overflow-scroll">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Excerpt</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($articles as $key => $article )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                @if($article->thumbnail != "")
                                <td><img class="feature_img" src="{{ asset("storage/thumbnail/".$article->thumbnail) }}" alt=""></td>
                                @else
                                <td>No thumbnail</td>
                                @endif
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->excerpt }}</td>
                                <td>{{ $article->category->name }}</td>
                                <td class="icon-action">
                                    <a href="{{ route("detail.article",$article->slug) }}" class="btn btn-outline-primary"><i class="fa-solid fa-clipboard-list"></i></a>
                                    <a href="{{ route("edit.article",$article->slug) }}" class="btn btn-outline-warning"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route("article.destroy",$article->id) }}" method="post" class="d-inline-block">
                                        @csrf
                                        @method("delete")
                                        <button class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">There is no article at this point!</td>
                            </tr>
                        @endforelse
                    </tbody>
                    {{ $articles->links() }}
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
@push("script")
<script src="{{ asset("js/sidebar.js") }}"></script>
@endpush