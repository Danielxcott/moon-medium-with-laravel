@php
use App\base;
use Illuminate\Support\Facades\Auth;
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
            @if ($reportActive > 0)
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
                <div class="online"></div>
                <!-- <div class="offline"></div> -->
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