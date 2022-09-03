@props(["article"])
<div class="article-related-item">
    <div class="article-related-owner">
        <a href="" class="article-owner-name">
            @if ($article->author->profile == "" && $article->author->avatar =="" )
            <img src="{{ asset("img/default/user.png") }}" alt="">
            @elseif ($article->author->profile == "" && $article->author->avatar !="")
            <img src="{{ $article->author->avatar }}" alt="">
            @else
            <img src="{{ asset("storage/profile/".$article->author->profile) }}" alt="">
            @endif
            @if ($article->author->name == "")
            <span>{{ $article->author->username }}</span>
            @else
            <span>{{ $article->author->name }}</span> 
            @endif
        </a>
        <a href="" class="article-category">{{ $article->category->name }}</a>
    </div>
    <a href="{{ route("show.farticle",$article->slug) }}" class="article-related-link">
        <div class="article-related-paragraph">
            <h3>{{ $article->title }}</h3>
            <p class="mb-0">{{ $article->excerpt }}</p>
        </div>
        @if ($article->thumbnail != "" && $article->thumbnail != null)
        <img src="{{ asset("storage/thumbnail/".$article->thumbnail) }}" alt="">
        @endif
    </a>
    <div class="divider-line"></div>
</div>