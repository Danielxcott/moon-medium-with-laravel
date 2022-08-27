@php
    use App\base;
@endphp
@extends("layouts.app")
@section("title") User Request @stop
@section("head")
<link rel="stylesheet" href="{{ asset("css/creator.css") }}">
@endsection
@section("content")
<section class="post-create-container">
    <div class="post-create-content">
        <div class="breadcrumb-nav">
           <h5 class="back-route"><a href="/dashboard.html">Dashboard</a></h5>
           <i class="fas fa-chevron-right"></i>
           <h5 class="current-route">User Request</h5>
        </div>
        <div class="post-create-card">
            <div class="header">
                <h4>User Request</h4>
            </div>
            <div class="post-create-card-body">
                <table class="table table-bordered overflow-scroll">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Profile</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Action</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($userRequests as $key => $userRequest )
                                <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                @if ($userRequest->user->profile == "" && $userRequest->user->avatar == "")
                                <img class="user_profile_img" src="{{ asset("img/default/user.png") }}" alt="">
                                    @elseif ($userRequest->user->profile == "" && $userRequest->user->avatar !== "")
                                    <img class="user_profile_img" src="{{ $userRequest->user->avatar }}" alt="">
                                    @else
                                    <img class="user_profile_img" src="{{ asset("storage/profile/".$userRequest->user->profile) }}" alt="">
                                @endif
                            </td>
                            <td>{{ $userRequest->user->username }}</td>
                            <td>{{ $userRequest->user->email  }}</td>
                            <td>{{ base::$gender[$userRequest->user->gender] }}</td>
                            <td class="">
                                <a href="/views/dashboard/post-detail.html" class="btn btn-outline-primary user-action-btn">Confirm</a>
                                <a href="" class="btn btn-outline-danger user-action-btn">Cancel</a>
                            </td>
                            <td>{{ $userRequest->created_at->format("d M Y") }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">No following-request currently.</td>
                        </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
