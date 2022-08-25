@php
    use Illuminate\Support\Str;
    use App\Models\Comment;
   $comments = Comment::where("article_owner_id",Auth::id())->where("status","0")->get();
@endphp
<nav class="noti-nav">
    <div class="noti-close"></div>
    <ul class=" noti-nav-option nav-pills" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active report-btn" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Report</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link report-btn" id="pills-comment-tab" data-bs-toggle="pill" data-bs-target="#pills-comment" type="button" role="tab" aria-controls="pills-comment" aria-selected="true">Comment</button>
          </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link report-btn" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Request</button>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
            <ul class="noti-list">
                @foreach ( $reports as $report )
                @if ($report->status == "active")
                <li class="noti-wrapper">
                    <a href="{{ route("update.report",[$report->article->slug,$report->id]) }}" class="noti-link">
                        <div class="noti-item">
                            @if ($report->user->profile == "" && $report->user->avatar == "")
                            <img src="{{ asset("img/default/user.png") }}" alt="">
                            @elseif($report->user->profile =="" && $report->user->avatar !== "")
                            <img src="{{ $report->user->avatar }}" alt="">
                            @else
                            <img src="{{ asset("storage/profile/".$report->user->profile) }}" alt="">
                            @endif
                            <div class="noti-title">
                                <h3>{{ $report->user->name }}</h3>
                                <p>{{ Str::words( $report->article->excerpt , 10) }}</p>
                            </div>
                        </div>
                    </a>
                </li>
                @else
                <li>
                   <h3 class="mb-0 text-center">No reports currently.</h3>
                </li> 
                @endif
                @endforeach
                @if ($reports->count() == "0")
                <li>
                    <h3 class="mb-0 text-center">No reports currently.</h3>
                 </li>  
                @endif
            </ul>
        </div>
        <div class="tab-pane fade show " id="pills-comment" role="tabpanel" aria-labelledby="pills-comment-tab" tabindex="0">
            <ul class="noti-list">
                @foreach ( $comments as $comment )
                @if ($comment->status == "0")
                <li class="noti-wrapper">
                    <a href="{{ route("update.comment",[$comment->article->slug,$comment->id]) }}" class="noti-link">
                        <div class="noti-item">
                            @if ($comment->user->profile == "" && $comment->user->avatar == "")
                            <img src="{{ asset("img/default/user.png") }}" alt="">
                            @elseif($comment->user->profile =="" && $comment->user->avatar !== "")
                            <img src="{{ $report->user->avatar }}" alt="">
                            @else
                            <img src="{{ asset("storage/profile/".$comment->user->profile) }}" alt="">
                            @endif
                            <div class="noti-title">
                                @if ($comment->user->name == null)
                                <h3>{{ $comment->user->username }}</h3>
                                @else
                                <h3>{{ $comment->user->name }}</h3>
                                @endif
                                <p>{{ Str::words( $comment->message , 10) }}</p>
                            </div>
                        </div>
                    </a>
                </li>
                @else
                <li>
                    <h3 class="mb-0 text-center">No comments currently.</h3>
                 </li> 
                @endif
                @endforeach
                @if ($comments->count() == "0")
                <li>
                    <h3 class="mb-0 text-center">No comments currently.</h3>
                 </li>  
                @endif
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