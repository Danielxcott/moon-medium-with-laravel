@php
    use Illuminate\Support\Str;
    use App\base;
@endphp
@extends("layouts.app")
@section("title") All Comments @stop
@section("head")
<link rel="stylesheet" href="{{ asset("css/creator.css") }}">
@endsection
@section("content")
<section class="post-create-container">
    <div class="post-create-content">
        <x-breadcrumb>
            <h5 class="back-route"><a href="{{ route("home") }}">Dashboard</a></h5>
           <i class="fas fa-chevron-right"></i>
           <h5 class="current-route">All Comments</h5>
        </x-breadcrumb>
        <div class="post-create-card">
            <div class="header">
                <h4>All Comments you have commented</h4>
            </div>
            <div class="post-create-card-body">
                <table class="table table-bordered overflow-scroll">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Comment</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($comments as $key=> $comment )
                        <tr>
                            <input type="hidden" class="remove_id" value="{{ $comment->id }}" name="remove_id">
                            <td>{{ $key+1 }}</td>
                            <td class="article">
                                <h3 class="mb-0">{{ $comment->article->title }}</h3>
                                <p class="mb-0">{{ Str::words($comment->article->excerpt,20) }}</p>
                            </td>
                            <td class="">{{ $comment->message }}</td>
                            @if ($comment->user->name == null)
                            <td>{{ base::removeSpace($comment->user->username )}}</td>
                            @else
                            <td>{{ ucwords($comment->user->name)}}</td>
                            @endif
                            <td class="action">
                                <a href="{{ route("detail.article",$comment->article->slug) }}" class="btn btn-outline-primary"><i class="fa-solid fa-clipboard-list"></i></a>
                                <form action="" class="d-inline-block">
                                    <button type="button" class="btn btn-outline-danger remove-btn"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                            <td>{{ $comment->created_at->format("d M Y") }}</td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No commment you have commented yet!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
@push("script")
    <script>
        let url = "{{ route('delete.comment') }}";
        $(".post-create-card .post-create-card-body").delegate(".remove-btn","click",function(){
        let getId = $(this).closest("tbody tr").find(".remove_id").val();
        $.post(url,{
            id:getId,
            _token : "{{ csrf_token() }}",
        }).done(function(data){
            $(".post-create-card .post-create-card-body").load(location.href+" .post-create-card .post-create-card-body");
            // console.log(data);
        })
    })
    </script>
@endpush