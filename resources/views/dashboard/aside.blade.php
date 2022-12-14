<aside>
    <div class="nav-close"></div>
    <div class="sidebar-head">
        <div class="logo-content">
            <img src="{{ asset("img/favicon.png") }}" alt="">
            <h4 class="mb-0">M<span><span>O</span>O</span>N</h4>
        </div>
        <i class="fa-solid fa-angle-right" id="back-btn"></i>
    </div>
        <ul class="nav-list p-0">
            <x-siderbar-item link="{{ route('home') }}" name="Dashboard" class="fa-home"></x-siderbar-item>
            @isAuthor
            <x-siderbar-item link="{{ route('article.create') }}" name="Create Post" class="fa-file-circle-plus"></x-siderbar-item>
            <x-siderbar-item link="{{ route('article.index') }}" name="All posts" class="fa-newspaper"></x-siderbar-item>
            @endisAuthor
            @isAdmin()
            <x-siderbar-item link="{{ route('article-category.create') }}" name="Create Category" class="fa-list-ul"></x-siderbar-item>
            @endisAdmin
            <x-siderbar-item link="{{ route('index.comment') }}" name="Comments" class="fa-comments"></x-siderbar-item>
            <x-siderbar-item link="{{ route('index.request') }}" name="User Request" class="fa-user-plus"></x-siderbar-item>
            @isAdmin()
            <x-siderbar-item link="{{ route('index.user') }}" name="All Users" class="fa-users"></x-siderbar-item>
            @endisAdmin
            @isAdmin
            <x-siderbar-item link="{{ route('index.report') }}" name="User Report" class="fa-circle-exclamation"></x-siderbar-item>  
            @endisAdmin 
        </ul>
    <div class="sidenav-footer">
        <ul class="sidebar-nav p-0">
            <li class="sidebar-item">
                <a  href="{{ route('logout') }}" class="sidebar-link" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <div class="link-items">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                            <span class="sidebar-link-text">Logout</span>
                    </div>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</aside>