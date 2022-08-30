@php
    use App\base;
@endphp
@extends("layouts.app")
@section("title") All Users @stop
@section("head")
<link rel="stylesheet" href="{{ asset("css/creator.css") }}">
@endsection
@section("content")
<section class="post-create-container">
    <div class="post-create-content">
        <x-breadcrumb>
            <h5 class="back-route"><a href="{{ route("home") }}">Dashboard</a></h5>
           <i class="fas fa-chevron-right"></i>
           <h5 class="current-route">All Users</h5>
        </x-breadcrumb>
        <div class="post-create-card">
            <div class="header">
                <h4>All Users</h4>
            </div>
            <div class="post-create-card-body">
                <table class="table table-bordered overflow-scroll">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Profile</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Active status</th>
                            <th>Action</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $users as $key=>$user )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            @if ($user->profile == "" && $user->avatar =="")
                                <td><img class="user_profile_img" src="{{ asset("img/default/user.png") }}" alt=""></td>
                              @elseif($user->profile =="" && $user->avatar !== "")
                              <td><img class="user_profile_img" src="{{ $user->avatar }}" alt=""></td>  
                              @else
                              <td><img class="user_profile_img" src="{{ asset("storage/profile/".$user->profile )}}" alt=""></td>
                            @endif
                            <td>{{ base::removeSpace($user->username) }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ base::$roles[$user->role] }}</td>
                            <td>
                                @if ($user->isOnline())
                                Online
                                @else
                                Offline
                                @endif
                            </td>
                            <td>
                                <a href="{{ route("detail.user",$user->username) }}" class="btn btn-outline-primary user-key-btn"><i class="fa-solid fa-clipboard-list"></i></a>
                                @if ($user->isBanned == "0")
                                <form action="{{ route("ban.user") }}" method="post" class="d-inline-block" id="banform{{ $user->id }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <button type="button" class="btn btn-outline-danger user-action-btn" onclick="return banConfirm({{ $user->id }})">Ban</button>
                                </form>
                                @else
                                <form action="{{ route("ban.user") }}" method="post" class="d-inline-block" id="unbanform{{ $user->id }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <button type="button" class="btn btn-outline-danger user-action-btn" onclick="return unbanConfirm({{ $user->id }})">Unban</button>
                                </form>
                                @endif
                                    <button class="btn btn-outline-warning user-key-btn" onclick="changePw({{ $user->id }},'{{ $user->name }}')"><i class="fas fa-key"></i></button>
                                
                            </td>
                            <td>{{ $user->created_at->format("d M Y h:i a") }}</td>
                            <td>{{ $user->updated_at->format("d M Y h:i a") }}</td>
                        </tr>
                        @empty
                           <tr>
                                <td colspan="8">There is no users at this point!</td>
                            </tr> 
                        @endforelse
                        
                    </tbody>
                    {{ $users->onEachSide(1)->links() }}
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
@push("script")
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset("js/sidebar.js") }}"></script>
<script>
    function banConfirm(id){
    banConfirmRole(id);       
    }
    function unbanConfirm(id){
        unBanConfirmRole(id);
    }
    function changePw(id,name)
    {
        let url = "{{ route('changePassword.user') }}";
        Swal.fire({
        title: "Do you want to change password for "+name+" ?",
        input: 'password',
        inputAttributes: {
          autocapitalize: 'off',
          required: "required",
          minLength: 8,
        },
        showCancelButton: true,
        confirmButtonText: 'Change',
        showLoaderOnConfirm: true,
        preConfirm: function (newPassword){
            $.post(url,{
                id : id,
                newpassword : newPassword,
                _token: "{{ csrf_token() }}" ,
            }).done(function(data){
                if(data.status == 200){
                    Swal.fire({
                        icon : "success",
                        title : "Password changed!",
                        text: data.message,
                    });
                }else{
                    Swal.fire({
                        icon : "error",
                        text: data.message,
                    });
                }
            })
        }
      })
    }
</script>
@endpush