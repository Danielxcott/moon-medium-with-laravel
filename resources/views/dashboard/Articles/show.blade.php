@php
   use App\Models\Article;
   use App\base;
@endphp
@extends("layouts.app")
@section("title") Article Detail @stop
@section("head")
<link rel="stylesheet" href="{{ asset("css/creator.css") }}">
@endsection
@section("content")
<section class="post-create-container">
    <div class="post-create-content">
        <x-breadcrumb>
            <h5 class="back-route"><a href="{{ route("home") }}">Dashboard</a></h5>
           <i class="fas fa-chevron-right"></i>
           <h5 class="back-route"><a href="{{ route("article.index") }}">All Posts</a></h5>
           <i class="fas fa-chevron-right"></i>
           <h5 class="current-route">Detail Post</h5>
        </x-breadcrumb>  
        <div class="article-content">
            <div class="article-card">
                <div class="article-wrapper">
                    <div class="article-owner">
                        <div class="article-owner-item">
                            @if ($article->author->profile == "" && $article->author->avatar  == "")
                            <img src="{{ asset("img/default/user.png") }}" alt="">
                            @elseif($article->author->profile  =="" && $article->author->avatar  !== "")
                            <img src="{{ $article->author->avatar }}" alt="">
                            @else
                            <img src="{{ asset("storage/profile/".$article->author->profile) }}" alt="">
                            @endif
                            <div class="article-owner-name">
                                @if ($article->author->name == null)
                                <p><a href="{{ route("detail.user",$article->author->username) }}">{{ ucwords($article->author->username) }}</a></p>
                                @else
                                <p><a href="{{ route("detail.user",$article->author->username) }}">{{ ucwords($article->author->name) }}</a></p>
                                @endif
                                <small class="article-category"><a href="/dashboard/article-search?category={{ $article->category->slug }}">{{ $article->category->name }}</a></small>
                                <small class="article-created">{{ $article->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <div class="btn-group">
                            <button class="btn dot-btn" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                <i class="fas fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{ route("detail.user",$article->author->username) }}">Profile</a></li>
                              @can("view",$article)
                              <li><a class="dropdown-item" href="{{ route("edit.article",$article->slug) }}">Edit</a></li>
                              <li><form action="{{ route("article.destroy",$article->id) }}" method="post">
                                @csrf
                                @method("delete")
                                <button class="btn btn-link text-decoration-none dropdown-item">Delete</button>    
                            </form></li>
                              @endcan
                              <li class="dropdown-item">
                                <div class="btn-group">
                                <button class="btn report-btn" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    Report
                                </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route("set.report",[$article->slug,"message"=>"0","id"=>Auth::id()]) }}">Spam</a>
                                        </li>
                                      <li><a class="dropdown-item" href="{{ route("set.report",[$article->slug,"message"=>"1","id"=>Auth::id()]) }}">Harassment</a></li>
                                      <li><a class="dropdown-item" href="{{ route("set.report",[$article->slug,"message"=>"2","id"=>Auth::id()]) }}">False Information</a></li>
                                    </ul>
                                  </div>
                                </li>
                            </ul>
                          </div>
                    </div>
                    <div class="article-detail-wrapper">
                        <div class="article-detail-item">
                            <h3>{{ $article->title }}</h3>
                            @if($article->thumbnail !== null)
                            <img src="{{ asset("storage/thumbnail/".$article->thumbnail) }}" alt="{{ $article->thumbnail }}">
                            @endif
                            @php
                                $decode = html_entity_decode($article->description,ENT_QUOTES);
                            @endphp
                            <div>
                                <?php echo $decode ?>
                            </div>
                            @isset($article->photos[0])
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                                <div class="carousel-inner">
                                  @foreach ($article->photos as $key => $image )
                                  <div class="carousel-item {{ $key === 0 ? "active" : "" }}">
                                    <img src="{{ asset("storage/article_images/".$image->images) }}" class="d-block" alt="...">
                                  </div>
                                  @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            @endisset
                        </div>
                        <div class="article-detail-controller">
                            <div class="reaction-controller">
                                <div class="reaction">
                                    <form action="{{ route("react.article",$article->slug) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @if (Auth::user()->isReacted($article))
                                        <button class="btn border-0 react-btn" ><i class="bi bi-heart-fill text-danger"></i></button>
                                        @else
                                        <button class="btn border-0 react-btn"><i class="bi bi-heart-fill"></i></button>
                                        @endif
                                    </form>
                                        <span onclick="viewerBtn(1)" class="reaction-count">{{ $article->reactors->count() }}</span>
                                </div>
                                <div class="comment" id="commentBtn1" onclick="commentBtn(1)">
                                    <i class="bi bi-chat-right-quote-fill"></i>   
                                    <span class="message-count">{{ $article->comments->count() }}</span>                     
                                </div>
                            </div>
                            @php
                            // $back = Article::where("id","<",$article->id)->first();
                            // $first = Article::all()->last();
                            $prevArticle = Article::where("id","<",$article->id)->latest("id")->first();
                            $nextArticle = Article::where("id",">",$article->id)->first();
                            @endphp
                            <div class="article-controller-item">
                                <a href="{{ isset($prevArticle) ? route("detail.article",$prevArticle->slug) : "#" }}" class="btn border-0 left-control @empty($prevArticle)
                                    disabled
                                @endempty"><i class="bi bi-arrow-left-circle"></i></a>
                                <a href="{{ route("article.index") }}" class="read-all">Read all</a>
                                <a href="{{ isset($nextArticle) ? route("detail.article",$nextArticle->slug) : "#" }}" class="btn border-0 right-control @empty($nextArticle)
                                    disabled
                                @endempty"><i class="bi bi-arrow-right-circle"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<x-reaction-viewer :article="$article" />
<x-comment-section :article="$article"/>
@push("script")
    <script src="{{ asset("js/sidebar.js") }}"></script>
    <script>
        let url = "{{ route('store.comment') }}";
        $(".comment-card .comment-box").delegate(".response-btn","click",function(){
            let message = $(this).closest(".comment-box").find("#message-box").val();
            let userId = $(this).closest(".comment-box").find(".user-id").val();
            let articleId = $(this).closest(".comment-box").find(".article-id").val();
            let articleOwnerId = $(this).closest(".comment-box").find(".article-owner-id").val();
            $.post(url,{
                message : message,
                user_id : userId,
                article_id : articleId,
                article_owner_id : articleOwnerId,
                _token : "{{ csrf_token() }}",
            }).done(function(data){
                console.log(data);
                $(".comment-card .comment-box").load(location.href+" .comment-card .comment-box");
                $(".comment-lists").load(location.href+" .comment-lists");
                loadmessageCount(articleId);
            });
        })
    </script>
@endpush