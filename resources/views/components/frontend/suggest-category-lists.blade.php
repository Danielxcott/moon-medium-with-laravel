<div class="category-lists">
   @foreach ($categories as $category )
   <x-frontend.suggest-category-item name="{{ $category->name }}" slug="{{ $category->slug }}" link="/search?category={{ $category->slug }}" />
   @endforeach
</div>