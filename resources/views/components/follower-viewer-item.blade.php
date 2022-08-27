@props(["yourfollower"])
<div class="reaction-viewers-item">
    <input type="hidden" value="{{ $yourfollower->user_id }}" class="currentReachId">
    <input type="hidden" value="{{ Auth::id() }}" class="ownerId">
    <div class="reaction-viewer-name">
        @if ($yourfollower->user->profile == "" && $yourfollower->user->avatar == "")
        <img src="{{ asset("img/default/user.png") }}" alt="">
        @elseif ($yourfollower->user->profile == "" && $yourfollower->user->avatar !== "")
        <img src="{{ $yourfollower->user->avatar }}" alt="">
        @else
        <img src="{{ asset("storage/profile/".$yourfollower->user->profile) }}" alt="">
        @endif
        @if ($yourfollower->user->name == null)
        <span><a href="{{ route("detail.user",$yourfollower->user->username) }}">{{ $yourfollower->user->username }}</a></span>
        @else
        <span><a href="{{ route("detail.user",$yourfollower->user->username) }}">{{ $yourfollower->user->name }}</a></span>
        @endif
    </div>
    @if (Auth::id() == $yourfollower->friend_id)
    <button class="reactor-follower remove-followed">Followed</button>
    @endif
</div>