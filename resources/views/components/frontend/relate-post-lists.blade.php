@props(["category","article"])
<div class="related-post-lists">
    @forelse ($articles as $article )
        <x-frontend.relate-post-item :article="$article"/>
    @empty    
        <h3 class="mb-0 text-center">No related article at this poin!</h3>
    @endforelse
</div>