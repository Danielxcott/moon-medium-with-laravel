@php
use App\Models\Comment;
use App\Models\UserRequest;
    $commentActive = Comment::where("article_owner_id",Auth::id())->where("user_id","!=",Auth::id())->where("status","0")->count();
$userRequests = UserRequest::where("friend_id",Auth::id())->where("status","0")->count();
@endphp
<nav>
    <h3 class="nav-title mb-0">
        <a href="{{ route("index.frontend") }}">MOON</a>
    </h3>
    <div class="nav-items">
        @if (!(request()->url() === route("user.usersearch")))
        <div class="search-box">
            <form action="{{ route("category.search") }}" id="search-btn">
                @if (request("category"))
                <input type="hidden" name="category" value="{{ request("category") }}">
                @endif
                <input type="search" name="article_name" placeholder="search" class="input-box">
            </form>
            <button type="button" class="search-btn" form="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </div>
        @else
        <div class="search-box">
            <form action="{{ route("user.search") }}" id="search-btn">
                <input type="search" name="search_user" placeholder="search" class="input-box">
            </form>
            <button type="button" class="search-btn" form="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </div>
        @endif
        @if (!(request()->url() === route("index.frontend"))) 
        <button type="button" class="profile-search nav-home">
            <a href="{{ route("index.frontend") }}">
                <i class="fas fa-home"></i>
            </a>
        </button>
        @endif
        <button type="button" class="profile-search nav-paragraph">
            <a href="{{ route("create.article") }}">
                <i class="fas fa-paragraph"></i>
            </a>
        </button>
        <button type="button" class="profile-search nav-users">
            <a href="{{ route("user.usersearch") }}">
                <i class="fas fa-users"></i>
            </a>
        </button>
        <button type="button" class="profile-search request-noti">
                <i class="fas fa-bell"></i>
                @if ($commentActive > 0 || $userRequests > 0)
                <div class="get-noti"></div>
                @endif  
        </button>
        <div class="user-profile">
            <div class="btn-group">
                <button class="btn" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                @if (Auth::user()->profile == "" && Auth::user()->avatar == "")
                    <img src="{{ asset("img/default/user.png") }}" class="user-img" alt="">
                    @elseif (Auth::user()->profile == "" && Auth::user()->avatar != "")
                    <img src="{{ Auth::user()->avatar }}" class="user-img" alt="">
                    @else
                    <img src="{{ asset("storage/profile/".Auth::user()->profile) }}" class="user-img" alt="">
                @endif
                <div class="active-status"></div>
                <div class="offline-status d-none"></div>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route("profile.user",Auth::user()->username) }}">Profile</a></li>
                    <li>
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
              </div>
        </div>
    </div>
</nav>