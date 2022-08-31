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
        @include("frontend.faside")
        <!--Aside end-->
        <!-- main start-->
        @yield("content")
        <!-- main end-->
    @endguest
       
    
    {{-- <div class="noti-nav">
        <div class="noti-close"></div>
        <div class="follower-noti-header">
            <h3>New requests</h3>
        </div>
        <ul class="follower-request-list">
            <li class="follower-request-item">
                <a href="" class="follower-request-content">
                    <img src="/assets/img/user/Teamwork-6.png" alt="">
                    <div class="follower-request-name">
                        <span>Lucifer</span>
                        <small>@lucifer</small>
                    </div>
                </a>
                    <button class="confirm-btn"><a href="">Request</a></button>
            </li>
            <li class="follower-request-item">
                <a href="" class="follower-request-content">
                    <img src="/assets/img/user/Teamwork-6.png" alt="">
                    <div class="follower-request-name">
                        <span>Lucifer</span>
                        <small>@lucifer</small>
                    </div>
                </a>
                    <button class="confirm-btn"><a href="">Request</a></button>
            </li>
            <li class="follower-request-item">
                <a href="" class="follower-request-content">
                    <img src="/assets/img/user/Teamwork-6.png" alt="">
                    <div class="follower-request-name">
                        <span>Lucifer</span>
                        <small>@lucifer</small>
                    </div>
                </a>
                    <button class="confirm-btn"><a href="">Request</a></button>
            </li>
            <li class="follower-request-item">
                <a href="" class="follower-request-content">
                    <img src="/assets/img/user/Teamwork-6.png" alt="">
                    <div class="follower-request-name">
                        <span>Lucifer</span>
                        <small>@lucifer</small>
                    </div>
                </a>
                    <button class="confirm-btn"><a href="">Request</a></button>
            </li>
        </ul>
    </div> --}}
    <script src="{{ asset("js/jquery.min.js") }}"></script>
    <script src="{{ asset("js/main.js") }}"></script>
    @stack("script")
</body>
</html>
