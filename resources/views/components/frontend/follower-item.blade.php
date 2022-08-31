@props(["follower"])
@php
    use App\base;
@endphp
<div class="follower-item">
    <input type="hidden" value="{{ Auth::id() }}" class="owner-id">
    <input type="hidden" value="{{ $follower->user_id }}" class="user-id">
    <div class="follower-user-profile">
    <a href="">
    @if (base::getFollowerName($follower->user_id)->profile == "" && base::getFollowerName($follower->user_id)->avatar == "")
    <img src="{{ asset("img/default/user.png") }}" alt="">
     @elseif (base::getFollowerName($follower->user_id)->profile == "" && base::getFollowerName($follower->user_id)->avatar != "")   
     <img src="{{ base::getFollowerName($follower->user_id)->avatar }}" alt="">
     @else
     <img src="{{ asset("storage/profile/".base::getFollowerName($follower->user_id)->profile) }}" alt="">
    @endif
    @if (base::getFollowerName($follower->user_id)->name == "")
    <span class="user-name">{{ base::getFollowerName($follower->user_id)->username }}</span>
     @else
     <span class="user-name">{{ base::getFollowerName($follower->user_id)->name }}</span>   
    @endif
    </a>
    @if (base::getFollowerName($follower->user_id)->isOnline())
    <div class="active-status"></div>
    @else
    <div class="offline-status"></div>
    @endif
    </div>
    <button class="unfollow-btn">Followed</button>
</div>