@extends("layouts.main")
@section("title") Moon Medium @stop
@section("head")
@endsection
@section("content")
<section class="main-content">
    <x-frontend.category-lists />
    <div class="content-wrapper">
        <div class="content-lists">
            @forelse ($articles as $article )
            @php
            $decode = html_entity_decode($article->excerpt,ENT_QUOTES);
            @endphp
            <div class="content-items">
                <div class="content-user-group">
                    <div class="user-profile">
                       <a href="{{ route("profile.user",$article->author->username) }}">
                        @if ($article->author->profile == "" && $article->author->avatar == "")
                            <img src="{{ asset("img/default/user.png") }}" class="user-img" alt="">
                            @elseif ($article->author->profile == "" && $article->author->avatar != "")
                            <img src="{{ $article->author->avatar }}" class="user-img" alt="">
                            @else
                            <img src="{{ asset("storage/profile/".$article->author->profile) }}" class="user-img" alt="">
                        @endif
                        @if ($article->author->name == "")
                            <small class="user-name">
                            {{ $article->author->username }}
                            </small>
                            @else
                            <small class="user-name">
                            {{ $article->author->name }}
                            </small>
                        @endif
                       </a>
                       @if ($article->author->isOnline())
                       <div class="active-status"></div>
                       @else
                       <div class="offline-status"></div>
                       @endif
                    </div>
                    <div class="btn-group">
                        <button class="btn" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
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
                <div class="content-article-group {{ $article->thumbnail ?? "flex-column align-items-start"  }}">
                    @if($article->thumbnail !== "" && $article->thumbnail !== null)
                    <img src="{{ asset("storage/thumbnail/".$article->thumbnail) }}" alt="">
                    @endif
                    <div class="article-paragraph">
                        <a href="{{ route("show.farticle",$article->slug) }}">
                        <h3>{{ $article->title }}</h3>
                        <p>{{ $article->excerpt }}</p>
                        </a>
                    </div>
                </div>
                <div class="content-article-footer">
                    <div>
                        <small>
                            <a href="search?category={{ $article->category->slug }}">{{ $article->category->name }}</a>
                        </small>
                        <small>{{ $article->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                <div class="divider-line"></div>
            </div>
            @empty
            <div class="text-center mb-0 vh-100 d-flex flex-column justify-content-center align-items-center">
                <img src="{{ asset("img/posts/alligator.jpeg") }}" class="w-100"  alt="">
                <h3 class="text-center no-article">No articles are added at this point!</h3>
            </div>
            @endforelse
            {{ $articles->links() }}
        </div>
    </div>
    <x-frontend.nav-menu />
</section>
@endsection