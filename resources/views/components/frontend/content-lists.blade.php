<div class="content-lists">
    @forelse ($articles as $article )
    <x-frontend.content-item :article="$article" />
    @empty
    <h3 class="text-center mb-0">No articles currently.</h3>
    @endforelse
    {{ $articles->links() }}
</div>