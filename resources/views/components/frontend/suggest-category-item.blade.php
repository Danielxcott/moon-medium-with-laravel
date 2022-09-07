<div class="category-item @if (request("category") === $slug)
active
@endif">
    <a href="{{ $link }}">{{ $name }}</a>
</div>