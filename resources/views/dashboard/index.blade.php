@extends("layouts.app")
@section("title") Dashboard @stop
@section("content")
<section class="content">
    <div class="quote-container">
        <div class="quote-text">
            <h4 class="text-header">Hello {{ ucwords(Auth::user()->name) }}</h4>
            <p class="paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus obcaecati quos, quidem dignissimos perspiciatis dolor aut. Eaque voluptates nostrum nesciunt.</p>
        </div>
        <img src="{{ asset("img/svg/work1.svg") }}" class="user-illustrator" alt="">
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
            <a href="">See All</a>
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
                            <img src="{{ asset("img/user/Teamwork-1.png") }}" class="viewer1" alt="">
                            <img src="{{ asset("img/user/Teamwork-2.png") }}" class="viewer-2" alt="">
                            <img src="{{ asset("img/user/Teamwork-3.png") }}" class="viewer-3" alt="">
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
                            <img src="{{ asset("img/user/Teamwork-3.png") }}" class="viewer1" alt="">
                            <img src="{{ asset("img/user/Teamwork-4.png") }}" class="viewer-2" alt="">
                            <img src="{{ asset("img/user/Teamwork-5.png") }}" class="viewer-3" alt="">
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
                            <img src="{{ asset("img/user/Teamwork-3.png") }}" class="viewer1" alt="">
                            <img src="{{ asset("img/user/Teamwork-6.png") }}" class="viewer-2" alt="">
                            <img src="{{ asset("img/user/Teamwork-7.png") }}" class="viewer-3" alt="">
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
                <img src="{{ asset("img/user/Teamwork-8.png") }}" class="viewer1" alt="">
                <img src="{{ asset("img/user/Teamwork-6.png") }}" class="viewer-2" alt="">
                <img src="{{ asset("img/user/Teamwork-3.png") }}" class="viewer-3" alt="">
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
                    <img src="{{ asset("img/user/Teamwork-2.png") }}" class="viewer1" alt=""> 
                </a><a href="">
                    <img src="{{ asset("img/user/Teamwork-8.png") }}" class="viewer1" alt=""> 
                </a>
                <a href="">
                    <img src="{{ asset("img/user/Teamwork-4.png") }}" class="viewer1" alt="">  
                </a>
                <a href="">
                    <img src="{{ asset("img/user/Teamwork-5.png") }}" class="viewer1" alt="">  
                </a>
                <a href="">
                    <img src="{{ asset("img/user/Teamwork-8.png") }}" class="viewer1" alt="">  
                </a>
                <a href="">
                    <img src="{{ asset("img/user/Teamwork-1.png") }}" class="viewer1" alt=""> 
                </a>
                <a href="">
                    <img src="{{ asset("img/user/Teamwork-2.png") }}" class="viewer1" alt=""> 
                </a>
                <a href="">
                    <img src="{{ asset("img/user/Teamwork-3.png") }}" class="viewer1" alt=""> 
                </a>
                <a href="">
                    <img src="{{ asset("img/user/Teamwork-7.png") }}" class="viewer1" alt=""> 
                </a>
            </div>
        </div>
</div>
</section>
@endsection
@push("script")
<script src="{{ asset("js/app.js") }}"></script>
<script>

</script>
@endpush