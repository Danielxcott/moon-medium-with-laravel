<div class="follower-lists">
    @forelse ($followers as $follower )
    <x-frontend.follower-item :follower="$follower" />
    @empty
    <div class="follower-item">
    <h3 class="text-center mb-0">You don't have follower at this point!</h3>
    </div>  
    @endforelse
</div>