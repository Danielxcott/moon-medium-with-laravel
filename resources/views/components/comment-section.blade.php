@props(["article"])
<div class="comment-asidenav">
    <div class="comment-aside-close"></div>
        <div class="comment-header">
            <h3>Comments(<span class="message-count">{{ $article->comments->count()}}</span>)</h3>
            <button class="close-com-btn"><i class="bi bi-x-lg"></i></button>
        </div>
        <x-form.comment-input-box :article="$article" />
    <ul class="comment-lists">
        @foreach ($article->comments as $comment )
            <x-comment-section-item :comment="$comment" />
        @endforeach
    </ul>
</div> 