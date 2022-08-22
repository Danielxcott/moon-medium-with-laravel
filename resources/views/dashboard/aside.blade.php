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
            <li class="sidebar-item" >
                <a href="" class="sidebar-link">
                    <div class="link-items">
                        <i class="fa-solid fa-home"></i>
                        <span class="sidebar-link-text">Dashboard</span>
                    </div>
            </a>
            </li>
            <li class="sidebar-item">
                <a href="/views/dashboard/add-post.html" class="sidebar-link">
                    <div class="link-items">
                        <i class="fa-solid fa-file-circle-plus"></i>
                        <span class="sidebar-link-text">Create Post</span>
                    </div>
                </a>
            </li>
            <li  class="sidebar-item">
                <a href="/views/dashboard/add-category.html" class="sidebar-link">
                    <div class="link-items">
                        <i class="fa-solid fa-list-ul"></i>
                        <span class="sidebar-link-text">Create Category</span>
                    </div>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="/views/dashboard/comment.html" class="sidebar-link">
                    <div class="link-items">
                        <i class="fa-solid fa-comments"></i>
                        <span class="sidebar-link-text">Comments</span>
                    </div>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="/views/dashboard/user-request.html" class="sidebar-link">
                    <div class="link-items">
                        <i class="fa-solid fa-user-plus"></i>
                        <span class="sidebar-link-text">New User Request</span>
                    </div>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="/views/dashboard/all-user.html" class="sidebar-link">
                    <div class="link-items">
                        <i class="fa-solid fa-users"></i>
                        <span class="sidebar-link-text">All Users</span>
                    </div>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="/views/dashboard/user-report.html" class="sidebar-link">
                    <div class="link-items">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span class="sidebar-link-text">User Report</span>
                    </div>
                </a>
            </li>
            
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