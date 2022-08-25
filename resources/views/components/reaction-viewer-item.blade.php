@props(["reactor"])
<div class="reaction-viewers-item">
    <div class="reaction-viewer-name">
        @if ($reactor->profile == "" && $reactor->avatar == "")
        <img src="{{ asset("img/default/user.png") }}" alt="">
        @elseif ($reactor->profile == "" && $reactor->avatar !== "")   
        <img src="{{ $reactor->avatar }}" alt=""> 
        @else
        <img src="{{ asset("storage/profile/".$reactor->profile) }}" alt="">
        @endif
       @if ($reactor->name == null)
       <span><a href="{{ route("detail.user",$reactor->username) }}">{{ base::$removeSpace($reactor->username) }}</a></span>
        @else
        <span><a href="{{ route("detail.user",$reactor->username) }}">{{ ucwords($reactor->name) }}</a></span>   
       @endif
    </div>
    <button class="reactor-follower"><a href="">Follow</a></button>
</div>