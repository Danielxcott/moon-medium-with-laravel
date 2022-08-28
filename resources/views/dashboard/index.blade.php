@extends("layouts.app")
@section("title") Dashboard @stop
@php
    use Illuminate\Support\Str;
@endphp
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
            <a href="{{ route("article.index") }}">See All</a>
        </div>
        <div class="owl-carousel trend-carousel owl-theme">
            @foreach ($articles as $article )
                @if ($article->reactors()->where("article_id",$article->id)->count() >= 2)
                <div class="item">
                    <a href="{{ route("detail.article",[$article->slug,"user_id"=>Auth::id(),"device"=>request()->server('HTTP_USER_AGENT'),"article_id"=>$article->id]) }}">
                        <div class="post-card">
                           <h4 class="post-header">{{ $article->title }}</h4>
                           <p class="post-paragraph">{{ Str::words($article->excerpt,30) }}</p>
                        </div>
                        <div class="post-controller">
                            <div class="post-viewers">
                                <?php $i=0 ?>
                                @foreach ($article->viewers as $key => $viewer ) 
                                <?php if(++$i == 4) break; ?>
                               @if ($viewer->user->profile == "" && $viewer->user->avatar == "")
                               <img src="{{ asset("img/default/user.png") }}" class="viewer{{ $key+1 }}" alt="">
                               @elseif ($viewer->user->profile == "" && $viewer->user->avatar !== "")
                               <img src="{{ $viewer->user->avatar }}" alt="">
                               @else
                               <img src="{{ asset("storage/profile/".$viewer->user->profile) }}" class="viewer{{ $key }}" alt="">
                               @endif
                                @endforeach 
                            </div>
                            <div class="post-likes">
                                <i class="fa-solid fa-heart"></i>
                                <p class="mb-0"><span>{{ $article->reactors->count() }}</span> likes</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
            @endforeach
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
@if ($users->count() >= 7)
<div class="new-user-card">
    <div class="user-title">
    <h4 class="mb-0">All Users</h4>
    <a href="">See all</a>
    </div>
    <div class="new-user-body">
        <div class="user-profile-left">
            @foreach ($users as $user)
            <a href="{{ route("detail.user",$user->username) }}">
            @if ($user->profile == "" && $user->avatar == "")
                <img src="{{ asset("img/default/user.png") }}" alt="">
            @elseif($user->profile =="" && $user->avatar !== "")
                <img src="{{ $user->avatar }}" alt="">
            @else
                <img src="{{ asset("storage/profile/".$user->profile) }}" class="viewer1" alt="">
            @endif
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif
</section>
@endsection
@push("script")
<script src="{{ asset("js/app.js") }}"></script>
<script>

</script>
@endpush