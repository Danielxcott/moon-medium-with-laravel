@props(["article"])
@php
       use App\base;
@endphp
<div class="comment-card">
    <div class="comment-owner">
        @if (Auth::user()->profile == "" && Auth::user()->avatar == "")
        <img src="{{ asset("img/default/user.png") }}" alt="">
        @elseif (Auth::user()->profile == "" && Auth::user()->avatar !== "") 
        <img src="{{ Auth::user()->avatar }}" alt="">   
        @else
        <img src="{{ asset("storage/profile/".Auth::user()->profile) }}" alt="">   
        @endif
        @if (Auth::user()->name == null)
            <span>{{ base::removeSpace(Auth::user()->username) }}</span>
            @else
            <span>{{ ucwords(Auth::user()->name)}}</span>
        @endif
    </div>
    <form action="" class="comment-box">
        <input type="hidden" class="user-id" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" class="article-id" name="article_id" value="{{ $article->id }}">
        <input type="hidden" class="article-owner-id" name="article_owner_id" value="{{ $article->user_id }}">
        <textarea name="message" id="message-box" class="form-control comment-input" placeholder="what are your thoughts?" cols="30" rows="5"></textarea>
        <button type="button" class="response-btn" >Response</button>
    </form>
</div>