<div class="noti-nav">
    <div class="noti-close"></div>
    <ul class=" noti-nav-option nav-pills" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active report-btn" id="pills-comment-tab" data-bs-toggle="pill" data-bs-target="#pills-comment" type="button" role="tab" aria-controls="pills-comment" aria-selected="true">Comment</button>
          </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link report-btn" id="pills-request-tab" data-bs-toggle="pill" data-bs-target="#pills-request" type="button" role="tab" aria-controls="pills-request" aria-selected="false">Request</button>
        </li>
      </ul>
        <div class="tab-pane fade show active" id="pills-comment" role="tabpanel" aria-labelledby="pills-comment-tab" tabindex="0">
            <ul class="noti-list">
                @forelse ( $comments as $comment )
                @if ($comment->status == "0")
                <li class="noti-wrapper">
                    <a href="{{ route("update.fcomment",[$comment->article->slug,$comment->id]) }}" class="noti-link">
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
                @empty
                <li>
                    <h3 class="mb-0 text-center">No comments currently.</h3>
                 </li> 
                @endforelse
            </ul>
        </div>
        <div class="tab-pane fade " id="pills-request" role="tabpanel" aria-labelledby="pills-request-tab" tabindex="0">
            <ul class="follower-request-list">
                @forelse ($userRequests as $userRequest )
                <li class="follower-request-item">
                    <a href="{{ route("profile.user",$userRequest->user->username) }}" class="follower-request-content">
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
</div>