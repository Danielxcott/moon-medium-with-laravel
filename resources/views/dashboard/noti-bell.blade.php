@php
    use Illuminate\Support\Str;
    use App\Models\Comment;
    use App\Models\UserRequest;
   $comments = Comment::where("article_owner_id",Auth::id())->where("user_id","!=",Auth::id())->where("status","0")->get();
   $userRequests = UserRequest::where("friend_id",Auth::id())->where("status","0")->get();
@endphp
<nav class="noti-nav">
    <div class="noti-close"></div>
    <ul class=" noti-nav-option nav-pills" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active report-btn" id="pills-report-tab" data-bs-toggle="pill" data-bs-target="#pills-report" type="button" role="tab" aria-controls="pills-report" aria-selected="true">Report</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link report-btn" id="pills-comment-tab" data-bs-toggle="pill" data-bs-target="#pills-comment" type="button" role="tab" aria-controls="pills-comment" aria-selected="true">Comment</button>
          </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link report-btn" id="pills-request-tab" data-bs-toggle="pill" data-bs-target="#pills-request" type="button" role="tab" aria-controls="pills-request" aria-selected="false">Request</button>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-report" role="tabpanel" aria-labelledby="pills-report-tab" tabindex="0">
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
        <div class="tab-pane fade show" id="pills-request" role="tabpanel" aria-labelledby="pills-request-tab" tabindex="0">
            <ul class="follower-request-list">
                @forelse ($userRequests as $userRequest )
                <li class="follower-request-item">
                    <a href="{{ route("detail.user",$userRequest->user->username) }}" class="follower-request-content">
                        @if ($userRequest->user->profile == "" && $userRequest->user->avatar == "")
                            <img src="{{ asset("img/default/user.png") }}" alt="">
                            @elseif($userRequest->user->profile =="" && $userRequest->user->avatar !== "")
                            <img src="{{ $userRequest->user->avatar }}" alt="">
                            @else
                            <img src="{{ asset("storage/profile/".$userRequest->user->profile) }}" alt="">
                        @endif
                        <div class="follower-request-name">
                            @if ($userRequest->user->name == null)
                                <span>{{ $userRequest->user->username }}</span>
                                @else
                                <span>{{ $userRequest->user->name }}</span>
                            @endif
                            <small>{{ $userRequest->user->username }}</small>
                        </div>
                    </a>
                        {{-- <button class="confirm-btn"><a href="">Request</a></button> --}}
                </li>
                @empty
                <li>
                    <h3 class="mb-0 text-center">No following-request currently.</h3>
                 </li> 
                @endforelse
            </ul>
        </div>
      </div>
</nav>