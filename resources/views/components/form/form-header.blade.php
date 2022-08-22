@props(['title','link','btn_name'])
<div class="header">
    <h4>{{ $title }}</h4>
    <div class="all-posts-route">
        <button><a href="{{ $link }}">{{ $btn_name }}</a></button>
    </div>
</div>