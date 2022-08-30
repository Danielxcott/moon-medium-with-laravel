<?php

namespace App\Http\Controllers;

use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreUserRequestRequest;
use App\Http\Requests\UpdateUserRequestRequest;

class UserRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userRequests = UserRequest::where("friend_id",Auth::id())->with(["user"])->where("status","0")->get();
        return view("dashboard.user.request",compact(["userRequests"]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequestRequest $request)
    {
        $userRequest = new UserRequest();
        $userRequest->user_id = $request->user_id;
        $userRequest->friend_id = $request->friend_id;
        $userRequest->status = "0";
        $userRequest->save();
        return response()->json(["status","message"=>"you send the friend request"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */
    public function show(UserRequest $userRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(UserRequest $userRequest)
    {
        //
    }

    public function followerCount(Request $request)
    {
       $count = UserRequest::where("friend_id",$request->id)->where("status","1")->count();
       return response()->json(["count"=>$count]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequestRequest  $request
     * @param  \App\Models\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validate = Validator::make($request->all(),[
            "currentReachId" => "required|".Rule::exists("users","id"),
        ]);
        if($validate->fails() || !(Auth::id()))
        {
            return response()->json(["status"=>422,"message"=>"the id is invalid"]);
        }else
        {
            $userRequest = UserRequest::where("friend_id",$request->owner_id)->where("user_id",$request->currentReachId)->first();
            $userRequest->status = "1";
            $userRequest->update();
        }
        
        return response()->json(["message"=>"you confrim current request"]);
    }

    public function destroyRequest(Request $request)
    {
        $userRequest = UserRequest::where("user_id",$request->currentReachId)->where("friend_id",$request->owner_id)->where("status","0");
        if($userRequest->exists())
        {
            $userRequest = UserRequest::where("user_id",$request->currentReachId)->where("friend_id",$request->owner_id)->where("status","0")->first();
            $userRequest->delete();
        }
        return response()->json(["message"=>"you removed pending request"]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */
    public function destroyFollowed(Request $request)
    {
        $validate = Validator::make($request->all(),[
            "currentReachId" => "required|".Rule::exists("users","id"),
        ]);
        if($validate->fails() || !(Auth::id()))
        {
            return response()->json(["status"=>422,"message"=>"the id is invalid"]);
        }else{
            $userRequest = UserRequest::where("user_id",$request->currentReachId)->where("friend_id",$request->owner_id)->where("status","1");
        if($userRequest->exists())
        {
            $userRequest = UserRequest::where("user_id",$request->currentReachId)->where("friend_id",$request->owner_id)->where("status","1")->first();
            $userRequest->delete();
            return response()->json(["message"=>"you removed unfollowed"]);
        }else{
            return response()->json(["message"=>"something wrong"]);
        }
        }
        
    }

    public function destroy(Request $request)
    {
        
        $userRequest = UserRequest::where("user_id",$request->user_id);
        if($userRequest->exists())
        {
            $userRequest = UserRequest::where("user_id",$request->user_id)->where("friend_id",$request->friend_id)->first();
            $userRequest->delete();
        }
        return response()->json(["status","message"=>"you removed the friend request."]);

    }
}
