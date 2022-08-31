<div class="category-lists">
   @foreach ($categories as $category )
   <x-frontend.suggest-category-item name="{{ $category->name }}" link="{{ $category->slug }}" />
   @endforeach
</div>