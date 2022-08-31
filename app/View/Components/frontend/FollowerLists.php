<?php

namespace App\View\Components\frontend;

use App\Models\UserRequest;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class FollowerLists extends Component
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
        $followers = UserRequest::where("friend_id",Auth::id())->where("status","1")->get();
        return view('components.frontend.follower-lists',compact(["followers"]));
    }
}
