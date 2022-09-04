<div class="nav-menu">
    <div class="nav-content">
        <div class="toggle-btn">
            <i class="bi bi-plus-lg"></i>
        </div>
        <span style="--i:1;">
            <a href="{{ route("profile.user",Auth::user()->username) }}">
                @if (Auth::user()->profile == "" && Auth::user()->avatar == "")
                <img src="{{ asset("img/default/user.png") }}" class="nav-menu-profile" alt="">
                @elseif (Auth::user()->profile == "" && Auth::user()->avatar != "")
                <img src="{{ Auth::user()->avatar }}" class="nav-menu-profile" alt="">
                @else
                <img src="{{ asset("storage/profile/".Auth::user()->profile) }}" class="nav-menu-profile" alt="">
            @endif
            </a>
        </span>
        <span style="--i:2;">
            <a href="{{ route("create.article") }}"><i class="fas fa-paragraph"></i></a>
        </span>
        <span style="--i:3;" class="">
            <a href="/views/frontend/user-search.html"><i class="fas fa-users"></i></a>
        </span>
    </div>
</div>