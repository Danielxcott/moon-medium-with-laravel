<div class="content-aside">
    <div class="followers">
        <h3 class="mb-0">Your Followers</h3>
        <x-frontend.follower-lists />
    </div>
    <div class="suggest-options">
        <div class="categories">
            <h3>Recommended Topics</h3>
            <x-frontend.suggest-category-lists/>
        </div>
    </div>
</div>
@push("script")
    <script>
        $(".follower-lists").delegate(".unfollow-btn","click",function(){
            let currentId = $(this).closest(".follower-item").find(".owner-id").val();
            let userId = $(this).closest(".follower-item").find(".user-id").val();
            let url = "{{ route('follower.removeFollower') }}";
            $.post(url,{
                "owner_id" : currentId,
                "currentReachId" : userId,
                _token : "{{ csrf_token() }}",
            }).done(function(data){
                $(".follower-lists .follower-item").load(location.href+" .follower-lists .follower-item");
                console.log(data);
            })
        })
    </script>
@endpush