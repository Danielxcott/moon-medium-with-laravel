@props(["article"])
<div class="related-post-item">
    <div class="related-post-owner">
        <div class="user-name">
            @if ($article->author->profile == "" && $article->author->avatar =="" )
            <img src="{{ asset("img/default/user.png") }}" alt="">
            @elseif ($article->author->profile == "" && $article->author->avatar !="")
            <img src="{{ $article->author->avatar }}" alt="">
            @else
            <img src="{{ asset("storage/profile/".$article->author->profile) }}" alt="">
            @endif
            @if ($article->author->name == "")
            <span><a href="{{ route('profile.user',$article->author->username) }}">{{ $article->author->username }}</a></span>
            @else
            <span><a href="{{ route('profile.user',$article->author->username) }}">{{ $article->author->name }}</a></span> 
            @endif
        </div>
        <a href="{{ route("show.farticle",$article->slug) }}" class="related-post-link">
        <p>{{ $article->title }}
        </p>
        </a>
    </div>
   @if ($article->thumbnail != "" && $article->thumbnail != null)
   <a href="{{ route("show.farticle",$article->slug) }}" class="related-post-img">
    <img src="{{ asset("storage/thumbnail/".$article->thumbnail) }}" alt="">
    </a>
   @endif
</div>