<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title")</title>
    <link rel="shortcut icon" href="{{ asset("img/favicon.png") }}" type="image/x-icon">
    <!--Core Css-->
    @vite(['resources/css/app.css', 'resources/sass/app.scss' ,'resources/js/app.js', 'resources/js/mychart.js'])
    <link rel="stylesheet" href="{{ asset("css/main.css") }}">
    @yield("head")
</head>
<body>
    @guest
       @yield("login-content") 
    @else
     <!--Nav start-->
        @include("frontend.fnav")
    <!--Nav end-->
        <!--Aside start-->
        @if (request()->url() === route("index.frontend") || request()->url() === route("user.usersearch") ||  request()->url() === route("category.search"))
        @include("frontend.faside")
        @endif
        <!--Aside end-->
        <!-- main start-->
        @yield("content")
        <!-- main end-->
    @endguest
       <x-frontend.noti-nav />
    <script src="{{ asset("js/jquery.min.js") }}"></script>
    <script src="{{ asset("js/main.js") }}"></script>
    @stack("script")
</body>
</html>
