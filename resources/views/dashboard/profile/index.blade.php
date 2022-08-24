@php
    use Illuminate\Support\Facades\Auth;
    use App\base;
@endphp
@extends("layouts.app")
@section("title") Profile @stop
@section("head")
<link rel="stylesheet" href="{{ asset("css/creator.css") }}">
@endsection
@section("content")
<section class="profile-card">
    <div class="profile-cover">
        @if ($user->cover_img == "")
            <img src="{{ asset("img/default/defaultcover.png") }}" alt="">
            @else
            <img src="{{ asset("storage/cover/".$user->cover_img) }}" alt="">
            @endif
        <div class="back-btn">
           <a href="{{ route("home") }}">
            <i class="fa-solid fa-chevron-left"></i>
           </a>
        </div>
    </div>
    <div class="profile-head">
        <div class="profile-pic">
            @if ($user->profile == "" && $user->avatar == "")
                <img src="{{ asset("img/default/user.png") }}" alt="">
                @elseif($user->profile =="" && $user->avatar !== "")
                <img src="{{ $user->avatar }}" alt="">
                @else
                <img src="{{ asset("storage/profile/".$user->profile) }}" alt="">
                @endif
        </div>
        <div class="profile-name-group">
            <div class="profile-name">
            @if ($user->name == null)
            <h4>{{ base::removeSpace($user->username) }}</h4>
            @else
            <h4>{{ ucwords($user->name)}}</h4>
            @endif
            <small>{{ "@".base::removeSpace($user->username) }}</small>
        </div>
            <div class="profile-follower-item">
                @if (Auth::id() !== $user->id)
                <button class="follow-btn "><a href="">Follow</a></button>
                @endif
                <button class="edit-btn "><a href="{{ route("edit.profile",$user->username) }}">Edit Profile</a></button>
            </div>
        </div>
    </div>
    <div class="profile-follower-wrapper">
        <div class="profile-follower-list">
            <div class="profile-follower-item">
                <span>{{ $user->articles->count() }}</span>
                <span>Posts</span>
            </div>
            <div class="profile-follower-item" id="viewer-follower" onclick="viewerFollower(1)">
                    <span>12</span>
                    <span>followers</span>
            </div>
            <div class="profile-follower-item d-none">
                <a href="">
                    <span>9</span>
                    <span>Following</span>
                </a>
            </div>
        </div>
        <div class="profile-bio">
            @isset($user->bio)
                <p>{{ $user->bio }}</p>
            @endisset
        </div>
    </div>
    <ul class="nav-tab nav-pills" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Posts</button>
          </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">About</button>
        </li>
      </ul>
   </section>
    <section class="profile-detail">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane about-tab fade " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                <div class="about">
                    <h3 class="mb-0">About</h3>
                </div>
                <div class="about-group">
                    <div class="group-item">
                        <div>
                            <i class="bi bi-at"></i>
                        </div>
                        <div>
                            <label>Username</label>
                            @isset($user->username)
                            <h3>{{ "@".base::removeSpace($user->username) }}</h3>
                            @endisset
                        </div>
                    </div>
                    <div class="group-item">
                        <div>
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <label>Name</label>
                            @isset($user->name)
                            <h3>{{ ucwords($user->name) }}</h3>
                            @endisset
                        </div>
                    </div>
                </div>
                <div class="about-group">
                    <div class="group-item">
                        <div>
                            <i class="bi bi-house-fill"></i>
                        </div>
                        <div>
                            <label>Live in</label>
                            @isset($user->livein)
                                <h3>{{ $user->livein }}</h3>
                            @endisset
                        </div>
                    </div>
                    <div class="group-item">
                        <div>
                            <i class="bi bi-phone-fill"></i>
                        </div>
                        <div>
                            <label>Mobile</label>
                            @isset($user->mobile)
                                <h3>{{ $user->mobile }}</h3>
                            @endisset
                        </div>
                    </div>
                </div>
                <div class="about-group">
                    <div class="group-item">
                        <div>
                            <i class="bi bi-stars text-warning"></i>
                        </div>
                        <div>
                            <label>Role</label>
                            <h3>{{ base::$roles[$user->role] }}</h3>
                        </div>
                    </div>
                    <div class="group-item">
                        <div>
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div>
                            <label>Email</label>
                            <h3>{{ $user->email }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane post-tab fade show active" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                <div class="about">
                    <h3 class="mb-0">Your Posts</h3>
                </div>
                <div class="post-article-lists">
                    @forelse ($user->articles as $article )
                    <div class="post-article-items">
                        <div class="content-user-group">
                            <div class="user-profile">
                               <a href="">
                                @if ($article->author->profile == "" && $article->author->avatar  == "")
                                <img src="{{ asset("img/default/user.png") }}" class="user-img" alt="">
                                @elseif($article->author->profile  =="" && $article->author->avatar  !== "")
                                <img src="{{ $user->avatar }}" class="user-img" alt="">
                                @else
                                <img src="{{ asset("storage/profile/".$article->author->profile) }}" class="user-img" alt="">
                                @endif
                                <small class="user-name">
                                    @if ($article->author->name == null)
                                    {{ ucwords($article->author->username) }}
                                    @else
                                    {{ $article->author->name }}
                                    @endif
                                </small>
                               </a>
                               <div class="active-status"></div>
                               <div class="offline-status d-none"></div>
                            </div>
                            <div class="btn-group">
                                <button class="btn" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    <i class="fas fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="{{ route("index.profile") }}">Profile</a></li>
                                  <li><a class="dropdown-item" href="{{ route("edit.article",$article->slug) }}">Edit</a></li>
                                  <li>
                                    <form action="{{ route("article.destroy",$article->id) }}" method="post">
                                        @csrf
                                        @method("delete")
                                        <button class="dropdown-item">Delete</button>
                                    </form>
                                  </li>
                                  <li class="dropdown-item">
                                    <div class="btn-group">
                                    <button class="btn report-btn" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                        Report
                                    </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                            <a class="dropdown-item" href="{{ route("set.report",[$article->slug,"message"=>"0","id"=>Auth::id()]) }}">Spam</a>
                                            </li>
                                            <li><a class="dropdown-item" href="{{ route("set.report",[$article->slug,"message"=>"1","id"=>Auth::id()]) }}">Harassment</a></li>
                                            <li><a class="dropdown-item" href="{{ route("set.report",[$article->slug,"message"=>"2","id"=>Auth::id()]) }}">False Information</a></li>
                                        </ul>
                                      </div>
                                    </li>
                                </ul>
                              </div>
                        </div>
                        <div class="content-article-group owner-article-group">
                            @isset($article->thumbnail)
                            <img src="{{ asset("storage/thumbnail/".$article->thumbnail) }}" alt="{{ $article->thumbnail }}">
                            @endisset
                            <div class="article-paragraph @empty($article->thumbnail)
                                w-100
                            @endempty">
                                <a href="{{ route("detail.article",$article->slug) }}">
                                <h3>{{ $article->title }}</h3>
                                <p>{{ $article->excerpt }}</p>
                                </a>
                            </div>
                        </div>
                        <div class="content-article-footer">
                            <div>
                                <small>
                                    <a href="">{{ $article->category->name }}</a>
                                </small>
                                <small>{{ $article->created_at->diffforHumans() }}</small>
                            </div>
                        </div>
                        <div class="divider-line"></div>
                    </div>
                    @empty
                    <img src="{{ asset("img/posts/alligator.jpeg") }}"  alt="">
                    <h3 class="text-center no-article">No articles are added at this point!</h3>
                    @endforelse
                </div>
            </div>
        </div>
    </section> 
@endsection
@push("script")
    <script src="{{ asset("js/sidebar.js") }}"></script>
@endpush