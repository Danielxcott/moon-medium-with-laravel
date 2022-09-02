@props(["article"])
@php
$decode = html_entity_decode($article->excerpt,ENT_QUOTES);
@endphp
<div class="content-items">
    <div class="content-user-group">
        <div class="user-profile">
           <a href="">
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
              <li><a class="dropdown-item" href="#">Profile</a></li>
              @can("view",$article)
              <li><a class="dropdown-item" href="#">Edit</a></li>
              <li><a class="dropdown-item" href="#">Delete</a></li>
              @endcan
              <li class="dropdown-item">
                <div class="btn-group">
                <button class="btn report-btn" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    Report
                </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Harassment</a></li>
                      <li><a class="dropdown-item" href="">False Information</a></li>
                    </ul>
                  </div>
                </li>
            </ul>
          </div>
    </div>
    <div class="content-article-group {{ $article->thumbnail ?? "flex-column align-items-start"  }}">
        @isset($article->thumbnail)
        <img src="{{ asset("storage/thumbnail/".$article->thumbnail) }}" alt="">
        @endisset
        <div class="article-paragraph">
            <a href="/views/frontend/post-detail.html">
            <h3>{{ $article->title }}</h3>
            <p><?php echo Str::words($decode, 50, '...') ?></p>
            </a>
        </div>
    </div>
    <div class="content-article-footer">
        <div>
            <small>
                <a href="">{{ $article->category->name }}</a>
            </small>
            <small>{{ $article->created_at->diffForHumans() }}</small>
        </div>
    </div>
</div>