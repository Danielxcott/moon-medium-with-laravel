<div class="post-article-items">
    <div class="content-user-group">
        <div class="user-profile">
           <a href="">
            @if ($article->author->profile == "" && $article->author->avatar  == "")
            <img src="{{ asset("img/default/user.png") }}" class="user-img" alt="">
            @elseif($article->author->profile  =="" && $article->author->avatar  !== "")
            <img src="{{ $user->avatar }}" class="user-img" alt="">
            @else
            <img src="{{ asset("storage/profile/".$article->author->profile) }}" class="user-img" alt="">
            @endif
            <small class="user-name">
                @if ($article->author->name == null)
                {{ ucwords($article->author->username) }}
                @else
                {{ $article->author->name }}
                @endif
            </small>
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
    <div class="content-article-group owner-article-group">
        @if($article->thumbnail != "" && $article->thumbnail != null)
        <img src="{{ asset("storage/thumbnail/".$article->thumbnail) }}" alt="{{ $article->thumbnail }}">
        @endif
        <div class="article-paragraph @empty($article->thumbnail)
            w-100
        @endempty">
            <a href="{{ route("show.farticle",$article->slug) }}">
            <h3>{{ $article->title }}</h3>
            <p>{{ $article->excerpt }}</p>
            </a>
        </div>
    </div>
    <div class="content-article-footer">
        <div>
            <small>
                <a href="/search?category={{ $article->category->slug }}">{{ $article->category->name }}</a>
            </small>
            <small>{{ $article->created_at->diffforHumans() }}</small>
        </div>
    </div>
    <div class="divider-line"></div>
</div>