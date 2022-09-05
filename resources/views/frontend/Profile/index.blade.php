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
                    <input type="hidden" class="user_id" value="{{ $user->id }}">
                    <input type="hidden" class="current_id" value="{{ Auth::id() }}">
                    @if (Auth::id() !== $user->id)
                        @if ($user->isSent($user->id))
                             <!-- a person who start to follow  -->
                                @if (Auth::user()->userRequests)
                                    @foreach (Auth::user()->userRequests as $userRequest )
                                        @if ($userRequest->friend_id == $user->id && $userRequest->status == "0")
                                        <button type="button" class="remove-btn">Pending</button> 
                                        @elseif ($userRequest->friend_id == $user->id && $userRequest->status == "1")
                                        <button type="button" class="remove-btn">Followed</button> 
                                        @endif
                                    @endforeach
                                @else
                                <button class="follow-btn">Follow</button>    
                                @endif
                        @else
                        @if (base::specificUser($user))
                            <div class="dropdown d-inline-block pending-btn">
                                <input type="hidden" value="{{ $user->id }}" class="currentReachId">
                                <input type="hidden" value="{{ Auth::id() }}" class="ownerId">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              pending
                                </button>
                                <ul class="dropdown-menu">
                                <li class="dropdown-item confirm-request" onclick="confirmRequest()">Confirm</li>
                                <li class="dropdown-item remove-request" onclick="removeRequest()">Remove</li>
                                </ul>
                            </div>
                        @else
                        @if (base::confirm($user))
                        <Button class="remove-follow" onclick="removeFollow()">Followed</Button> 
                        @else
                        <button class="follow-btn">Follow</button>     
                    @endif  
                    @endif
                    @endif
                    @endif

                    @if (Auth::id() == $user->id)
                    <button class="edit-btn"><a href="{{ route("profile.edit.user",$user->username) }}">Edit Profile</a></button>
                    @endif
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
<x-follower-viewer :yourfollowers="$yourfollowers" />

@endsection
@push("script")
    <script>
         $(".profile-head").delegate(".follow-btn","click",function(){
            let url = "{{ route('set.userrequest') }}";
            let currentId = $(this).closest(".profile-follower-item").find(".current_id").val();
            let userId = $(this).closest(".profile-follower-item").find(".user_id").val();
            $.post(url,{
                friend_id : userId,
                user_id : currentId,
                _token : "{{ csrf_token() }}",
            }).done(function(data){
                $(".profile-head .profile-follower-item").load(location.href+" .profile-head .profile-follower-item");
                console.log(data);
            })
        })
        $(".profile-head").delegate(".remove-btn","click",function(){
            let url = "{{ route('remove.userrequest') }}";
            let currentId = $(this).closest(".profile-follower-item").find(".current_id").val();
            let userId = $(this).closest(".profile-follower-item").find(".user_id").val();
            $.post(url,{
                friend_id : userId,
                user_id : currentId,
                _token : "{{ csrf_token() }}",
            }).done(function(data){
                $(".profile-head .profile-follower-item").load(location.href+" .profile-head .profile-follower-item");
                console.log(data);
            })
        })
        $("#viewerFollower1 .reaction-viewers-lists").delegate(".remove-followed","click",function(){
            let currentId = $(this).closest(".reaction-viewers-item").find(".ownerId").val();
            let userId = $(this).closest(".reaction-viewers-item").find(".currentReachId").val();
            let url = "{{ route('remove.userfollowed') }}";
            $.post(url,{
                "owner_id" : currentId,
                "currentReachId" : userId,
                _token : "{{ csrf_token() }}",
            }).done(function(data){
                $(".reaction-viewers-lists").load(location.href+" .reaction-viewers-lists");
                loadFollowerCount(currentId);
                console.log(data);
            })
        })
    </script>
@endpush
