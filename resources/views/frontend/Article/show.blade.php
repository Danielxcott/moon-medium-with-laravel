@extends("layouts.main")
@section("title") Article Detail @stop
@php
    use App\Models\Article;

   $decode = html_entity_decode($article->description,ENT_QUOTES);
   $prevArticle = Article::where("id","<",$article->id)->latest("id")->first();
    $nextArticle = Article::where("id",">",$article->id)->first();
  @endphp
@section("head")
@endsection
@section("content")
<!-- laptop article-related -->
<div class="content-aside">
    <div class="related-post">
        <h3 class="mb-0">Related Posts</h3>
        <x-frontend.relate-post-lists :category="$article->category_id" :article="$article->id" />
    </div>
    <div class="suggest-options">
        <div class="categories">
            <h3>Recommended Topics</h3>
            <x-frontend.suggest-category-lists/>
        </div>
    </div>
</div>
<!-- Main Content -->
<section class="article-content">
    <div class="article-card">
        <div class="article-wrapper">
            <div class="article-owner">
                <div class="article-owner-item">
                    @if ($article->author->profile == "" && $article->author->avatar =="" )
                    <img src="{{ asset("img/default/user.png") }}" alt="">
                    @elseif ($article->author->profile == "" && $article->author->avatar !="")
                    <img src="{{ $article->author->avatar }}" alt="">
                    @else
                    <img src="{{ asset("storage/profile/".$article->author->profile) }}" alt="">
                    @endif
                    
                    <div class="article-owner-name">
                        @if ($article->author->name == "")
                        <p><a href="{{ route("profile.user",$article->author->username) }}">{{ $article->author->username }}</a></p>
                        @else
                        <p><a href="{{ route("profile.user",$article->author->username) }}">{{ $article->author->name }}</a></p> 
                        @endif
                        <small class="article-category"><a href="/search?category={{ $article->category->slug }}">{{ $article->category->name }}</a></small>
                        <small class="article-created">{{ $article->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                <div class="btn-group">
                    <button class="btn dot-btn" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        <i class="fas fa-ellipsis-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ route("profile.user",$article->author->username) }}">Profile</a></li>
                      @can("view",$article)
                      <li><a class="dropdown-item" href="{{ route("edit.farticle",$article->slug) }}">Edit</a></li>
                      <li><form action="{{ route("remove.farticle",$article->id) }}" method="post">
                        @csrf
                        @method("delete")
                        <button class="btn btn-link text-decoration-none dropdown-item">Delete</button>    
                    </form></li>
                      @endcan
                      @if (Auth::id() !== $article->author->id)
                      <li class="dropdown-item">
                        <div class="btn-group">
                        <button class="btn report-btn" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            Report
                        </button>
                            
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route("set.freport",[$article->slug,"message"=>"0","id"=>Auth::id()]) }}">Spam</a>
                                </li>
                              <li><a class="dropdown-item" href="{{ route("set.freport",[$article->slug,"message"=>"1","id"=>Auth::id()]) }}">Harassment</a></li>
                              <li><a class="dropdown-item" href="{{ route("set.freport",[$article->slug,"message"=>"2","id"=>Auth::id()]) }}">False Information</a></li>
                            </ul> 
                           
                          </div>
                        </li>
                        @endif
                    </ul>
                  </div>
            </div>
            <div class="article-detail-wrapper">
                <div class="article-detail-item">
                    <h3>{{ $article->title }}</h3>
                    @if($article->thumbnail !== "" && $article->thumbnail !== null)
                    <img src="{{ asset("storage/thumbnail/".$article->thumbnail) }}" alt="">
                    @endif
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
                            <form action="{{ route("react.farticle",$article->slug) }}" method="POST" class="d-inline-block">
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
                    <div class="article-controller-item">
                        <a href="{{ isset($prevArticle) ? route("show.farticle",$prevArticle->slug) : "#" }}" class="btn border-0 left-control @empty($prevArticle)
                            disabled
                        @endempty"><i class="bi bi-arrow-left-circle"></i></a>
                        <a href="{{ route("index.frontend") }}" class="read-all">Read all</a>
                        <a href="{{ isset($nextArticle) ? route("show.farticle",$nextArticle->slug) : "#" }}" class="btn border-0 right-control @empty($nextArticle)
                            disabled
                        @endempty"><i class="bi bi-arrow-right-circle"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-frontend.nav-menu />
</section>
<!-- Mobile article-related -->
<x-frontend.relate-post-lists-mobile :categoryId="$article->category_id" :articleId="$article->id" />
<x-reaction-viewer :article="$article" />
<x-comment-section :article="$article"/>
@endsection
@push("script")
    {{-- <script src="{{ asset("js/sidebar.js") }}"></script> --}}
    <script>
        let url = "{{ route('store.fcomment') }}";
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