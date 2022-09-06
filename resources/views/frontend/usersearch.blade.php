@php
    use App\base;
@endphp
@extends("layouts.main")
@section("title") Moon medium @stop
@section("head")
    
@endsection
@section("content")
<div class="refresh">
    <section class="main-content user-search-content">
        <div class="user-wrapper">
         <h3 class="mb-0">Who to follow</h3>
         <div class="newuser-lists">
            
            @foreach ($users as $user)
            <div class="newuser-item">
               <div class="newuser-content">
                   @if ($user->profile == "" && $user->avatar == "")
                   <img src="{{ asset("img/default/user.png") }}" alt="">
                   @elseif($user->profile =="" && $user->avatar !== "")
                   <img src="{{ $user->avatar }}" alt="">
                   @else
                   <img src="{{ asset("storage/profile/".$user->profile) }}" alt="">
                   @endif
                   <div class="user-name">
                       <a href="{{ route("profile.user",$user->username) }}">
                           @if ($user->name == null)
                           <p class="mb-0">{{ base::removeSpace($user->username) }}</p>
                           @else
                           <p class="mb-0">{{ ucwords($user->name)}}</p>
                           @endif
                       @isset($user->bio)
                           <span>{{ $user->bio }}</span>
                       @endisset
                       </a>
                   </div>
               </div>
               <div class="follow-place">
                   <input type="hidden" class="user_id" value="{{ $user->id }}">
                   <input type="hidden" class="current_id" value="{{ Auth::id() }}">
                   @if ($user->isSent($user->id))
                                <!-- a person who start to follow  -->
                                   @if (Auth::user()->userRequests)
                                       @foreach (Auth::user()->userRequests as $userRequest )
                                           @if ($userRequest->friend_id == $user->id && $userRequest->status == "0")
                                           <button type="button" class="newuser-btn remove-btn">Pending</button> 
                                           @elseif ($userRequest->friend_id == $user->id && $userRequest->status == "1")
                                           <button type="button" class="newuser-btn remove-btn">Followed</button> 
                                           @endif
                                       @endforeach
                                   @else
                                         <button class="newuser-btn follow-btn">Follow</button>   
                                   @endif
                           @else
                           @if (base::specificUser($user))
                               <div class="dropdown d-inline-block pending-btn newuser-btn">
                                   <input type="hidden" value="{{ $user->id }}" class="currentReachId">
                                   <input type="hidden" value="{{ Auth::id() }}" class="ownerId">
                                   <button class="btn btn-link text-decoration-none p-0 text-white" style="font-size: 1.2rem" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                 pending
                                   </button>
                                   <ul class="dropdown-menu">
                                   <li class="dropdown-item confirm-request" onclick="cr()">Confirm</li>
                                   <li class="dropdown-item remove-request" onclick="rr()">Remove</li>
                                   </ul>
                               </div>
                           @else
                           @if (base::confirm($user))
                           <Button class="newuser-btn remove-follow" onclick="rf()">Followed</Button> 
                           @else
                                 <button class="newuser-btn follow-btn">Follow</button>    
                       @endif  
                       @endif
                       @endif
               </div>
           </div>
            @endforeach
         </div>
        </div>
        <x-frontend.nav-menu />
     </section>
    @endsection
</div>
@push("script")
    <script>
        $(".refresh").delegate(".follow-btn","click",function(){
            let url = "{{ route('set.userrequest') }}";
            let currentId = $(this).closest(".follow-place").find(".current_id").val();
            let userId = $(this).closest(".follow-place").find(".user_id").val();
            console.log(currentId,userId);
            $.post(url,{
                friend_id : userId,
                user_id : currentId,
                _token : "{{ csrf_token() }}",
            }).done(function(data){
                $(".refresh").load(location.href+" .refresh");
                console.log(data);
            })
        })
        $(".refresh").delegate(".remove-btn","click",function(){
            let url = "{{ route('remove.userrequest') }}";
            let currentId = $(this).closest(".follow-place").find(".current_id").val();
            let userId = $(this).closest(".follow-place").find(".user_id").val();
            $.post(url,{
                friend_id : userId,
                user_id : currentId,
                _token : "{{ csrf_token() }}",
            }).done(function(data){
                $(".refresh").load(location.href+" .refresh");
                console.log(data);
            })
        })
    </script>
@endpush