@extends("layouts.main")
@section("title") Edit Profile @stop
@section("content")
<section class="profile-content create-form-wrapper">
    <form action="{{ route("profile.update.user",$user->username) }}" id="edit-profile" method="POST" enctype="multipart/form-data">
        @csrf
        @method("put")
    </form>
    <div class="profile-card">
        <div class="profile-cover edit-profile-cover">
            @if ($user->cover_img == "")
            <img src="{{ asset("img/default/defaultcover.png") }}" alt="">
            @else
            <img src="{{ asset("storage/cover/".$user->cover_img) }}" alt="">
            @endif
            <div class="edit-cover-photo">
                <input type="file"  id="cover-input"  name="cover_img" form="edit-profile" class="d-none">
                <div class="edit-cover-btn">
                    <i class="fa-solid fa-pen-to-square"></i>                
                    <small>Edit cover photo <span class="current-img-extension"></span></small>
                </div>
            </div>
            @error("cover_img")
            <div class="error-cover-message is-invalid">
                <small>{{ $message }}</small>
            </div>
            @enderror
        </div>
        <div class="profile-head">
            <div class="profile-pic edit-profile-pic">
                @if ($user->profile == "" && $user->avatar == "")
                <img src="{{ asset("img/default/user.png") }}" alt="">
                @elseif($user->profile =="" && $user->avatar !== "")
                <img src="{{ $user->avatar }}" alt="">
                @else
                <img src="{{ asset("storage/profile/".$user->profile) }}" alt="">
                @endif
                <div class="edit-profile-photo">
                    <input type="file"  id="profile-input" value="" name="profile" form="edit-profile" class="d-none">
                    <div class="edit-profile-btn">
                        <i class="fa-solid fa-pen-to-square"></i>                
                        <small>Edit profile photo</small>
                    </div>
                </div>
                @error("profile")
                <div class="error-profile-message is-invalid">
                    <small>{{ $message }}</small>
                </div>
                @enderror
            </div>
            <div class="profile-edit-group">
                <div class="profile-follower-item">
                    <button form="edit-profile" class="update-profile-btn" type="submit">Update</button>
                    <button><a href="{{ route("index.frontend") }}">Cancel</a></button>
                </div>
            </div>
        </div>
        <div class="profile-edit-wrapper">
            <div class="profile-edit-item">
                <label for="">Name</label>
                <input type="name" name="name" required class="form-control @error("name") is-invalid @enderror" form="edit-profile" value="{{ old("name",$user->name) }}">
                @error("name")
                    <div class="invalid-feedback">
                        <p class="mb-0">{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <div class="profile-edit-item">
                <label for="">Username</label>
                <input type="text" name="username" required class="form-control @error("username") is-invalid @enderror" form="edit-profile" value="{{ old("username",$user->username) }}">
                @error("username")
                    <div class="invalid-feedback">
                        <p class="mb-0">{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <div class="profile-edit-item">
                <label for="">Email</label>
                <input type="email" name="email" required class="form-control @error("email") is-invalid @enderror" form="edit-profile" value="{{ old("email",$user->email) }}">
                @error("email")
                    <div class="invalid-feedback">
                        <p class="mb-0">{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <!-- <div class="profile-edit-item">
                <label for="password">Password</label>
                <input type="password" name="password" required class="form-control" form="edit-profile" value="">
            </div> -->
            <div class="profile-edit-item">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" form="edit-profile" class="form-select @error("gender") is-invalid @enderror">
                    <option value="0" disabled {{ $user->gender == "0" ? "selected" : "" }}>Select Gender</option>
                    <option value="1" {{ $user->gender == "1" ? "selected" : "" }}>Male</option>
                    <option value="2" {{ $user->gender == "2" ? "selected" : "" }}>Female</option>
                </select>
                @error("gender")
                    <div class="invalid-feedback">
                        <p class="mb-0">{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <div class="profile-edit-item">
                <label for="live_in">Live in</label>
                <input type="text" id="live_in" name="livein" required class="form-control @error("livein") is-invalid @enderror" form="edit-profile" value="{{ old("livein",$user->livein) }}">
                @error("livein")
                    <div class="invalid-feedback">
                        <p class="mb-0">{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <div class="profile-edit-item">
                <label for="mobile">Mobile</label>
                <input type="number" required name="mobile" class="form-control @error("mobile") is-invalid @enderror" form="edit-profile" value="{{ old("mobile",$user->mobile) }}">
                @error("mobile")
                    <div class="invalid-feedback">
                        <p class="mb-0">{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <div class="profile-edit-item">
                <label for="bio">Bio</label>
                <textarea name="bio" id="bio" cols="30" form="edit-profile" class="form-control bio-form @error("bio") is-invalid @enderror" rows="5">{{ $user->bio }}</textarea>
                @error("bio")
                    <div class="invalid-feedback">
                        <p class="mb-0">{{ $message }}</p>
                    </div>
                @enderror
            </div>
        </div>
       </div>
       <x-frontend.nav-menu />
</section>
@endsection