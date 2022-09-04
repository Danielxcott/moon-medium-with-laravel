@extends("layouts.main")
@php
    use App\base;
    use App\Models\UserRequest;
    $yourfollowers = UserRequest::Where("friend_id",$user->id)->where("status","1")->get();
@endphp
@section("title") Profile @stop
@section("head")
    
@endsection
@section("content")
<section class="profile-content">
    <div class="profile-card">
        <div class="profile-cover">
            @if ($user->cover_img == "")
            <img src="{{ asset("img/default/defaultcover.png") }}" alt="">
            @else
            <img src="{{ asset("storage/cover/".$user->cover_img) }}" alt="">
            @endif
            <div class="back-btn">
               <a href="{{ route('index.frontend') }}">
                <i class="fa-solid fa-chevron-left"></i>
               </a>
            </div>
        </div>
        <div class="profile-head">
            <div class="profile-pic">
                @if ($user->profile == "" && $user->avatar == "")
                <img src="{{ asset("img/default/user.png") }}" alt="">
                @elseif($user->profile =="" && $user->avatar !== "")
                <img src="{{ $user->avatar }}" alt="">
                @else
                <img src="{{ asset("storage/profile/".$user->profile) }}" alt="">
                @endif
            </div>
            <div class="profile-name-group">
                <div class="profile-name">
                    @if ($user->name == null)
                    <h4>{{ base::removeSpace($user->username) }}</h4>
                    @else
                    <h4>{{ ucwords($user->name)}}</h4>
                    @endif
                    <small>{{ "@".base::removeSpace($user->username) }}</small>
                </div>
                <div class="profile-follower-item">
                    <button><a href="">Follow</a></button>
                    <button><a href="{{ route("profile.edit.user",$user->username) }}">Edit Profile</a></button>
                </div>
            </div>
        </div>
        <div class="profile-follower-wrapper">
            <div class="profile-follower-list">
                <div class="profile-follower-item">
                    <span>{{ $user->articles->count() }}</span>
                    <span>Posts</span>
                </div>
                <div class="profile-follower-item" id="viewer-follower" onclick="viewerFollower(1)">
                    <span class="follower-count">{{ $yourfollowers->count() }}</span>
                        <span>followers</span>
                </div>
                <div class="profile-follower-item d-none">
                    <a href="">
                        <span>9</span>
                        <span>Following</span>
                    </a>
                </div>
            </div>
            <div class="profile-bio">
                @isset($user->bio)
                <p>{{ $user->bio }}</p>
            @endisset
            </div>
        </div>
        <ul class="nav-tab nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Posts</button>
              </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">About</button>
            </li>
          </ul>
       </div>
        <div class="profile-detail">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane post-tab fade show active" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                    <div class="about">
                        <h3 class="mb-0">Your Posts</h3>
                    </div>
                    <x-frontend.post-article-lists :user="$user->id"/>
                </div>
                <div class="tab-pane about-tab fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                    <div class="about">
                        <h3 class="mb-0">About</h3>
                    </div>
                    <div class="about-group">
                        <div class="group-item">
                            <div>
                                <i class="bi bi-at"></i>
                            </div>
                            <div>
                                <label>Username</label>
                                @isset($user->username)
                                <h3>{{ "@".base::removeSpace($user->username) }}</h3>
                                @endisset
                            </div>
                        </div>
                        <div class="group-item">
                            <div>
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <label>Name</label>
                                @isset($user->name)
                                <h3>{{ ucwords($user->name) }}</h3>
                                @endisset
                            </div>
                        </div>
                    </div>
                    <div class="about-group">
                        <div class="group-item">
                            <div>
                                <i class="bi bi-house-fill"></i>
                            </div>
                            <div>
                                <label>Live in</label>
                                @isset($user->livein)
                                <h3>{{ $user->livein }}</h3>
                            @endisset
                            </div>
                        </div>
                        <div class="group-item">
                            <div>
                                <i class="bi bi-phone-fill"></i>
                            </div>
                            <div>
                                <label>Mobile</label>
                                @isset($user->mobile)
                                <h3>{{ $user->mobile }}</h3>
                            @endisset
                            </div>
                        </div>
                    </div>
                    <div class="about-group">
                        <div class="group-item">
                            <div>
                                <i class="fa-solid fa-venus-mars"></i>
                            </div>
                            <div>
                                <label>Gender</label>
                                @isset($user->gender)
                                <h3>{{ base::$gender[$user->gender] }}</h3>
                            @endisset
                            </div>
                        </div>
                        <div class="group-item">
                            <div>
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div>
                                <label>Email</label>
                                <h3>{{ $user->email }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-frontend.nav-menu />
</section>
@endsection
