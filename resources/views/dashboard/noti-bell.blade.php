<nav class="noti-nav">
    <div class="noti-close"></div>
    <ul class=" noti-nav-option nav-pills" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active report-btn" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Report</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link report-btn" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Request</button>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
            <ul class="noti-list">
                <li class="noti-wrapper">
                    <a href="" class="noti-link">
                        <div class="noti-item">
                            <img src="{{ asset("img/user/Teamwork-2.png") }}" alt="">
                            <div class="noti-title">
                                <h3>Thomas</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis mole ...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="noti-wrapper">
                    <a href="" class="noti-link">
                        <div class="noti-item">
                            <img src="{{ asset("img/user/Teamwork-3.png") }}" alt="">
                            <div class="noti-title">
                                <h3>Andrea</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis mole ...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="noti-wrapper">
                    <a href="" class="noti-link">
                        <div class="noti-item">
                            <img src="{{ asset("img/user/Teamwork-4.png") }}" alt="">
                            <div class="noti-title">
                                <h3>Taylor</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis mole ...</p>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
            <ul class="follower-request-list">
                <li class="follower-request-item">
                    <a href="" class="follower-request-content">
                        <img src="{{ asset("img/user/Teamwork-6.png") }}" alt="">
                        <div class="follower-request-name">
                            <span>Lucifer</span>
                            <small>@lucifer</small>
                        </div>
                    </a>
                        <button class="confirm-btn"><a href="">Request</a></button>
                </li>
                <li class="follower-request-item">
                    <a href="" class="follower-request-content">
                        <img src="{{ asset("img/user/Teamwork-7.png") }}" alt="">
                        <div class="follower-request-name">
                            <span>Lucifer</span>
                            <small>@lucifer</small>
                        </div>
                    </a>
                        <button class="confirm-btn"><a href="">Request</a></button>
                </li>
                <li class="follower-request-item">
                    <a href="" class="follower-request-content">
                        <img src="{{ asset("img/user/Teamwork-1.png") }}" alt="">
                        <div class="follower-request-name">
                            <span>Lucifer</span>
                            <small>@lucifer</small>
                        </div>
                    </a>
                        <button class="confirm-btn"><a href="">Request</a></button>
                </li>
                <li class="follower-request-item">
                    <a href="" class="follower-request-content">
                        <img src="{{ asset("img/user/Teamwork-3.png") }}" alt="">
                        <div class="follower-request-name">
                            <span>Lucifer</span>
                            <small>@lucifer</small>
                        </div>
                    </a>
                        <button class="confirm-btn"><a href="">Request</a></button>
                </li>
            </ul>
        </div>
      </div>
</nav>