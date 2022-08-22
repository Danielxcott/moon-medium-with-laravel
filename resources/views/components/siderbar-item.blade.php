@props(['class','name','link'])
<li class="sidebar-item {{ request()->url() === $link ? "active" : "" }}" >
    <x-sidebar-link :class="$class" :name="$name" :link="$link" />
</li>