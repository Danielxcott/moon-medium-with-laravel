@props(["user"])
<div class="post-article-lists">
   @forelse ($posts as $article)
   <x-frontend.post-article-item :article="$article"/>
   @empty
   <img src="{{ asset("img/posts/alligator.jpeg") }}" class="w-100"  alt="">
   <h3 class="text-center no-article">No articles are added at this point!</h3>
   @endforelse
   {{ $posts->links() }}
</div>