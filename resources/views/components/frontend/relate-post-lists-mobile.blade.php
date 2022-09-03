@props(["categoryId","articleId"])
<section class="article-related-content">
    <h3 class="article-header">Related articles</h3>
    @forelse ($articles as $article )
    <x-frontend.relate-post-item-mobile :article="$article"/>
    @empty
    <h3 class="mb-0 text-center">No related articles at this point!</h3>
    @endforelse
</section>