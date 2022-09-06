<?php

namespace App\View\Components\frontend;

use App\Models\Comment;
use App\Models\UserRequest;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class NotiNav extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $comments = Comment::where("article_owner_id",Auth::id())->where("user_id","!=",Auth::id())->where("status","0")->get();
        $userRequests = UserRequest::where("friend_id",Auth::id())->where("status","0")->get();
        return view('components.frontend.noti-nav',compact(["comments","userRequests"]));
    }
}
