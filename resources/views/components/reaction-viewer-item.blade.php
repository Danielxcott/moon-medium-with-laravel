@props(["reactor"])
<div class="reaction-viewers-item">
    <div class="reaction-viewer-name">
        <img src="{{ asset("storage/profile/".$reactor->profile) }}" alt="">
        <span><a href="{{ route("detail.user",$reactor->username) }}">{{ $reactor->name }}</a></span>
    </div>
    <button class="reactor-follower"><a href="">Follow</a></button>
</div>