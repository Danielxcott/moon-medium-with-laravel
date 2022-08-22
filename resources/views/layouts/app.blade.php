<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <!--Core Css File-->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!--CSS File-->
    <link rel="stylesheet" href="{{ asset("css/animate.css/animate.min.css") }}">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("css/form.css") }}">
    @yield("head")
</head>
<body>
    @guest
        @yield('login-content')
        @else
         <!--Aside start-->
    <aside>
        <div class="nav-close"></div>
        <div class="sidebar-head">
            <div class="logo-content">
                <img src="assets/img/favicon.png" alt="">
                <h4 class="mb-0">M<span><span>O</span>O</span>N</h4>
            </div>
            <i class="fa-solid fa-angle-right" id="back-btn"></i>
        </div>
            <ul class="nav-list p-0">
                <li class="sidebar-item" >
                    <a href="" class="sidebar-link">
                        <div class="link-items">
                            <i class="fa-solid fa-home"></i>
                            <span class="sidebar-link-text">Dashboard</span>
                        </div>
                </a>
                </li>
                <li class="sidebar-item">
                    <a href="/views/dashboard/add-post.html" class="sidebar-link">
                        <div class="link-items">
                            <i class="fa-solid fa-file-circle-plus"></i>
                            <span class="sidebar-link-text">Create Post</span>
                        </div>
                    </a>
                </li>
                <li  class="sidebar-item">
                    <a href="/views/dashboard/add-category.html" class="sidebar-link">
                        <div class="link-items">
                            <i class="fa-solid fa-list-ul"></i>
                            <span class="sidebar-link-text">Create Category</span>
                        </div>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/views/dashboard/comment.html" class="sidebar-link">
                        <div class="link-items">
                            <i class="fa-solid fa-comments"></i>
                            <span class="sidebar-link-text">Comments</span>
                        </div>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/views/dashboard/user-request.html" class="sidebar-link">
                        <div class="link-items">
                            <i class="fa-solid fa-user-plus"></i>
                            <span class="sidebar-link-text">New User Request</span>
                        </div>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/views/dashboard/all-user.html" class="sidebar-link">
                        <div class="link-items">
                            <i class="fa-solid fa-users"></i>
                            <span class="sidebar-link-text">All Users</span>
                        </div>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/views/dashboard/user-report.html" class="sidebar-link">
                        <div class="link-items">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <span class="sidebar-link-text">User Report</span>
                        </div>
                    </a>
                </li>
                
            </ul>
        <div class="sidenav-footer">
            <ul class="sidebar-nav p-0">
                <li class="sidebar-item">
                    <a href="views/dashboard/login.html" class="sidebar-link">
                        <div class="link-items">
                                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                <span class="sidebar-link-text">Logout</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <!--Aside end-->
    <!--Main content-->
    <main>
        <!--Navbar start-->
        <div class="nav">
            <div class="burger-nav">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <div class="burger-mobile" onclick="change()">
                <div class="line4"></div>
                <div class="line5"></div>
                <div class="line6"></div>
            </div>
            <div class="navitem-box">
                <div class="search-box">
                    <div class="form-groups">
                        <form action="">
                            <input type="search" class="form-controls" placeholder="Search">
                        </form>
                        <i class="fas fa-search"></i>
                    </div>
                </div>
                <div class="noti-group">
                    <div class="noti-bell">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="noti-status"></div>
                </div>
                <div class="profile-group" id="dropbox-btn">
                        <div class="profile">
                            <div class="profile-name">
                                <p class="mb-0">Lucien</p>
                                <span class="text-black-50">Admin</span>
                            </div>
                            <img src="assets/img/user/Upstream-1.png" class="user-profile" alt="">
                        </div>
                    <div class="active-status">
                        <div class="online"></div>
                        <!-- <div class="offline"></div> -->
                    </div>
                    <div class="profile-dropbox">
                        <ul class="dropbox-list p-0">
                            <li class="drop-list-item">
                                <a href="views/dashboard/profile.html">
                                    <i class="fas fa-user"></i>
                                    <span class="ms-3">Profile</span>
                                </a>
                            </li>
                            <li class="drop-list-item">
                                <a href="views/dashboard/login.html">
                                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                <span class="ms-3">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> 
        <!--Navbar end-->
        <!--Content section-->
        <section class="content">
            <div class="quote-container">
                <div class="quote-text">
                    <h4 class="text-header">Hello Lucien</h4>
                    <p class="paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus obcaecati quos, quidem dignissimos perspiciatis dolor aut. Eaque voluptates nostrum nesciunt.</p>
                </div>
                <img src="assets/img/svg/work1.svg" class="user-illustrator" alt="">
            </div>
            <div class="weather-container">
                <div class="text-container">
                    <div class="temp">
                        <h3 class="number mb-0">-</h3>
                        <span class="deg">°C</span>
                    </div>
                    <div class="weather-detail">
                        <p class="weather mb-0">-----</p>
                        <p class="location mb-0">--,--</p>
                        <div class="w-detail">
                            <p class="feel-like">Feels like : <span class="temp">--°C</span></p>|
                            <p class="humidity">Humidity : <span class="percent">-%</span></p>
                        </div>
                    </div>
                </div>
                <!-- <img src="assets/img/Weather Icons/cloud.svg" class="weather-illustrator" alt=""> -->
            </div>
        </section>
        <section class="post-content">
            <div class="trend-post">
                <div class="post-title">
                    <h4 class="mb-0">Trending Posts</h4>
                    <a href="/views/dashboard/trending-post.html">See All</a>
                </div>
                <div class="owl-carousel trend-carousel owl-theme">
                    <div class="item">
                        <a href="">
                            <div class="post-card">
                               <h4 class="post-header">Lorem ipsum dolor sit amet consectetur.</h4>
                               <p class="post-paragraph">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cumque neque aperiam tenetur debitis. Illum recusandae provident expedita aut sapiente alias ...</p>
                            </div>
                            <div class="post-controller">
                                <div class="post-viewers">
                                    <img src="assets/img/user/Teamwork-1.png" class="viewer1" alt="">
                                    <img src="assets/img/user/Teamwork-2.png" class="viewer-2" alt="">
                                    <img src="assets/img/user/Teamwork-3.png" class="viewer-3" alt="">
                                </div>
                                <div class="post-likes">
                                    <i class="fa-solid fa-heart"></i>
                                    <p class="mb-0"><span>24</span> likes</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="">
                            <div class="post-card">
                               <h4 class="post-header">Lorem ipsum dolor sit amet consectetur.</h4>
                               <p class="post-paragraph">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cumque neque aperiam tenetur debitis. Illum recusandae provident expedita aut sapiente alias ...</p>
                            </div>
                            <div class="post-controller">
                                <div class="post-viewers">
                                    <img src="assets/img/user/Teamwork-1.png" class="viewer1" alt="">
                                    <img src="assets/img/user/Teamwork-2.png" class="viewer-2" alt="">
                                    <img src="assets/img/user/Teamwork-3.png" class="viewer-3" alt="">
                                </div>
                                <div class="post-likes">
                                    <i class="fa-solid fa-heart"></i>
                                    <p class="mb-0"><span>24</span> likes</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="">
                            <div class="post-card">
                               <h4 class="post-header">Lorem ipsum dolor sit amet consectetur.</h4>
                               <p class="post-paragraph">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cumque neque aperiam tenetur debitis. Illum recusandae provident expedita aut sapiente alias ...</p>
                            </div>
                            <div class="post-controller">
                                <div class="post-viewers">
                                    <img src="assets/img/user/Teamwork-1.png" class="viewer1" alt="">
                                    <img src="assets/img/user/Teamwork-2.png" class="viewer-2" alt="">
                                    <img src="assets/img/user/Teamwork-3.png" class="viewer-3" alt="">
                                </div>
                                <div class="post-likes">
                                    <i class="fa-solid fa-heart"></i>
                                    <p class="mb-0"><span>24</span> likes</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="chart-wrapper">
                <div class="chart-card">
                    <div class="post-viewers">
                        <h4 class="mb-0">Viewers & Posts</h4>
                        <div class="viewers-profile">
                        <img src="assets/img/user/Teamwork-1.png" class="viewer1" alt="">
                        <img src="assets/img/user/Teamwork-2.png" class="viewer-2" alt="">
                        <img src="assets/img/user/Teamwork-3.png" class="viewer-3" alt="">
                        </div>
                    </div>
                    <canvas id="ov"></canvas>
                </div>
            </div>
        </section>
        <section class="box-content">
        <div class="new-user-card">
                <div class="user-title">
                <h4 class="mb-0">All Users</h4>
                <a href="">See all</a>
                </div>
                <div class="new-user-body">
                    <div class="user-profile-left">
                        <a href="">
                            <img src="assets/img/user/Teamwork-5.png" class="viewer1" alt=""> 
                        </a><a href="">
                            <img src="assets/img/user/Teamwork-6.png" class="viewer1" alt=""> 
                        </a>
                        <a href="">
                            <img src="assets/img/user/Teamwork-1.png" class="viewer1" alt=""> 
                        </a>
                        <a href="">
                            <img src="assets/img/user/Teamwork-2.png" class="viewer1" alt=""> 
                        </a>
                        <a href="">
                            <img src="assets/img/user/Teamwork-3.png" class="viewer1" alt=""> 
                        </a>
                        <a href="">
                            <img src="assets/img/user/Teamwork-4.png" class="viewer1" alt=""> 
                        </a>
                        <a href="">
                            <img src="assets/img/user/Teamwork-2.png" class="viewer1" alt=""> 
                        </a>
                        <a href="">
                            <img src="assets/img/user/Teamwork-4.png" class="viewer1" alt=""> 
                        </a>
                        <a href="">
                            <img src="assets/img/user/Teamwork-7.png" class="viewer1" alt=""> 
                        </a>
                    </div>
                </div>
        </div>
        </section>
    </main>
     <!--Main content-->
    <!--Noti-bar-->
    <nav class="noti-nav">
        <div class="noti-close"></div>
        <ul class=" noti-nav-option nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active report-btn" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Report</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link report-btn" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Request</button>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                <ul class="noti-list">
                    <li class="noti-wrapper">
                        <a href="" class="noti-link">
                            <div class="noti-item">
                                <img src="assets/img/user/Teamwork-7.png" alt="">
                                <div class="noti-title">
                                    <h3>Thomas</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis mole ...</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="noti-wrapper">
                        <a href="" class="noti-link">
                            <div class="noti-item">
                                <img src="assets/img/user/Teamwork-3.png" alt="">
                                <div class="noti-title">
                                    <h3>Andrea</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis mole ...</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="noti-wrapper">
                        <a href="" class="noti-link">
                            <div class="noti-item">
                                <img src="assets/img/user/Teamwork-4.png" alt="">
                                <div class="noti-title">
                                    <h3>Taylor</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis mole ...</p>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
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
            </div>
          </div>
    </nav>
    <!--Noti-bar end-->
    @endguest
    <!--Core Js File-->
    <script src="{{ asset("js/jquery.min.js") }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
    <script src="{{ asset("js/sidebar.js") }}"></script>
</body>
</html>