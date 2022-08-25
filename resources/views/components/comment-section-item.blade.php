@props(["comment"])
@php
       use App\base;
@endphp
<li class="comment-item">
    <div class="user-item-group">
        @if ($comment->user->profile == "" && $comment->user->avatar == "")
        <img src="{{ asset("img/default/user.png") }}" alt="">
        @elseif ($comment->user->profile == "" && $comment->user->avatar !== "") 
        <img src="{{ $comment->user->avatar }}" alt="">   
        @else
        <img src="{{ asset("storage/profile/".$comment->user->profile) }}" alt="">   
        @endif
        <div class="user-name">
            @if ($comment->user->name == null)
            <a href="{{ route("detail.user",$comment->user->username) }}"><p>{{ base::removeSpace($comment->user->username) }}</p></a>
            @else
            <a href="{{ route("detail.user",$comment->user->username) }}"><p>{{ $comment->user->name }}</p></a>    
            @endif
            <span>{{ $comment->created_at->diffForHumans() }}</span>
        </div>
    </div>
    <p class="comment-paragraph">{{ $comment->message }}</p>
    <div class="comment-controller">
        <span></span>
        <span class="reply-btn">reply</span>
    </div>
    <div class="divider-line"></div>
</li>