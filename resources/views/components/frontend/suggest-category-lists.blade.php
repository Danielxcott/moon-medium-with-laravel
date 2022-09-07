<div class="category-lists">
   @foreach ($categories as $category )
      <div class="category-item @if (request("category") === $category->slug) active @endif">
    <a href="/search?category={{ $category->slug }}{{ request('article_name') ? "&article_name=".request('article_name') : "" }}">{{ $category->name }}</a>
</div>
   @endforeach
</div>