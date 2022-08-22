@php
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
            <div class="noti-status"></div>
        </div>
        <div class="profile-group" id="dropbox-btn">
                <div class="profile">
                    <div class="profile-name">
                        <p class="mb-0">{{ ucwords(Auth::user()->name)}}</p>
                        <span class="text-black-50">Admin</span>
                    </div>
                    <img src="{{ asset("img/user/Teamwork-1.png") }}" class="user-profile" alt="">
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