@extends("layouts.main")
@section("title") Moon Medium @stop
@section("head")
@endsection
@section("content")
<section class="main-content">
    <x-frontend.category-lists />
    <div class="content-wrapper">
    <x-frontend.content-lists />
    </div>
    <x-frontend.nav-menu />
</section>
@endsection