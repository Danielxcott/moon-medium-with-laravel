<nav>
    <h3 class="nav-title mb-0">
        <a href="/index.html">MOON</a>
    </h3>
    <div class="nav-items">
        <div class="search-box">
            <form action="" id="search-btn">
                <input type="search" placeholder="search" class="input-box">
            </form>
            <button type="button" class="search-btn" form="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </div>
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
            <a href="/views/frontend/user-search.html">
                <i class="fas fa-users"></i>
            </a>
        </button>
        <button type="button" class="profile-search request-noti">
                <i class="fas fa-bell"></i>
                <div class="get-noti"></div>
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
                    <li><a class="dropdown-item" href="/views/frontend/profile.html">Profile</a></li>
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