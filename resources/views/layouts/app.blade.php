<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title")</title>
    <link rel="shortcut icon" href="{{ asset("img/favicon.png") }}" type="image/x-icon">
    <!--Core Css File-->
    @vite(['resources/css/app.css', 'resources/sass/app.scss' ,'resources/js/app.js', 'resources/js/mychart.js'])
    <!--CSS File-->
    <link rel="stylesheet" href="{{ asset("css/animate.css/animate.min.css") }}">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    @yield("head")
</head>
<body>
    @guest
        @yield('login-content')
        @else
         <!--Aside start-->
    @include("dashboard.aside")
    <!--Aside end-->
    <!--Main content-->
    <main>
        <!--Navbar start-->
        @include("dashboard.navbar")
        <!--Navbar end-->
        <!--Content section-->
        @yield("content")
    </main>
     <!--Main content-->
    <!--Noti-bar-->
    @include("dashboard.noti-bell")
    <!--Noti-bar end-->
    @endguest
    <!--Core Js File-->
    <script src="{{ asset("js/jquery.min.js") }}"></script>
    @stack("script")
</body>
</html>