@php
use App\base;
use App\Models\Comment;
use App\Models\UserRequest;
use Illuminate\Support\Facades\Auth;
$commentActive = Comment::where("article_owner_id",Auth::id())->where("user_id","!=",Auth::id())->where("status","0")->count();
$userRequests = UserRequest::where("friend_id",Auth::id())->where("status","0")->count();
@endphp

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
        @if (request()->url() !== route("index.user"))
        <div class="search-box">
            <div class="form-groups">
                <form action="{{ route("article.search") }}" method="get">
                    @if (request("category"))
                    <input type="hidden" name="category" value="{{ request("category") }}">
                    @endif
                    <input type="search" name="article_name" class="form-controls" id="mainSearch" placeholder="Search">
                </form>
                <i class="fas fa-search"></i>
            </div>
        </div>
        @endif
        @if (request()->url() == route("index.user"))
        <div class="search-box">
            <div class="form-groups">
                <form action="{{ route("index.user") }}" method="get">
                    <input type="search" name="search_user" value="{{ request("search_user") ?? request("search_user") }}"  class="form-controls" id="userSearch" placeholder="Search">
                </form>
                <i class="fas fa-search"></i>
            </div>
        </div>
        @endif
        <div class="noti-group">
            <div class="noti-bell">
                <i class="fas fa-bell"></i>
            </div>
            @if ($reportActive > 0 || $commentActive > 0 || $userRequests > 0)
            <div class="noti-status"></div> 
            @endif
        </div>
        <div class="profile-group" id="dropbox-btn">
                <div class="profile">
                    <div class="profile-name">
                        @if (Auth::user()->name == null)
                            <p class="mb-0">{{ base::removeSpace(Auth::user()->username)}}</p>
                           @else
                           <p class="mb-0">{{ ucwords(Auth::user()->name)}}</p> 
                        @endif
                        <span class="text-black-50">{{ base::$roles[Auth::user()->role] }}</span>
                    </div>
                @if (Auth::user()->profile == "" && Auth::user()->avatar == "")
                <img src="{{ asset("img/default/user.png") }}" class="user-profile" alt="">
                @elseif(Auth::user()->profile =="" && Auth::user()->avatar !== "")
                <img src="{{ Auth::user()->avatar }}" class="user-profile" alt="">
                @else
                <img src="{{ asset("storage/profile/".Auth::user()->profile) }}" class="user-profile" alt="">
                @endif
                </div>
            <div class="active-status">
                @if (Auth::user()->isOnline())
                <div class="online"></div>
                @else
                <div class="offline"></div>
                @endif
            </div>
            <div class="profile-dropbox">
                <ul class="dropbox-list p-0">
                    <li class="drop-list-item">
                        <a href="{{ route("index.profile") }}">
                            <i class="fas fa-user"></i>
                            <span class="ms-3">Profile</span>
                        </a>
                    </li>
                    <li class="drop-list-item">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        <span class="ms-3">Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div> 
@push("script")
<script>
     var availableTags=[] ;
        $.ajax({
            method: "GET",
            url : "/dashboard/article-lists",
            success: function (response)
            {
            let array = response;
               for(x in array)
               {
                if(Object.keys(array[x])[0] === "title")
                {
                    availableTags.push(array[x].title)
                }
                getData(array[x].title);
               }
            }
        })
     function getData(response)
     {
        $( "#mainSearch" ).autocomplete({
        source: availableTags,
     });
     }
</script>
@endpush