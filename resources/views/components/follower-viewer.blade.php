@props(["yourfollowers"])
<div class="reaction-viewers" id="viewerFollower1">
    <div class="reaction-viewers-close" id="viewerFollowerClose1" onclick="closeViewerFollower(1)"></div>
    <div class="reaction-viewers-wrapper">
        <div class="reaction-viewer-title">
            <p><span class="follower-count">{{ $yourfollowers->count() }}</span> Followers</p>
            <button onclick="closeViewerFollower(1)"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="reaction-viewers-lists">
            @forelse ($yourfollowers as $yourfollower )
                <x-follower-viewer-item :yourfollower="$yourfollower" />
            @empty
            <div class="reaction-viewers-item">
                <h1 class="text-center mb-0 w-100">No followers currently.</h1>
            </div>
            @endforelse
            
        </div>
    </div>  
</div>