<div class="category-lists-mobile">
    @foreach ($categories as $category )
    <x-frontend.category-item name="{{ $category->name }}" link="{{ $category->slug }}" />
    @endforeach
</div>