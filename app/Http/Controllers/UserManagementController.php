<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller
{
    public function index(User $user)
    {
        Gate::authorize("view",$user);
        $users = User::orderBy("id","DESC")
        ->with(["userRequests","articles","article","reactedArticle"])
        ->filter(request(["search_user"]))
        ->paginate("10")
        ->withQueryString();
        return view("dashboard.user.index",compact("users"));
    }

    public function banUser(Request $request)
    {
        $user = User::find($request->id);
        switch ($user->isBanned) {
            case '0':
                $user->isBanned = "1";
                break;
            default:
                $user->isBanned ="0";
                break;
        }
        $user->update();
        return back();
    }

    public function changePassword(Request $request)
    {
        $validate = Validator::make($request->all(),[
            "newpassword" => "required|min:8",  
          ]);
          if($validate->fails()){
            return response()->json(["status"=>422,"message"=>$validate->errors()]);
          }
        $user = User::find($request->id);
        if($user->role == "1")
        {
            $user->password = Hash::make($request->newpassword);
            $user->update();
            return response()->json(["status"=>200,"message"=>"Password is successfully changed"]);
        }else
        {
            return response()->json(["status"=>422,"message"=>"You can't change admin password!!"]);
        }
    }

    public function show($username)
    {
       $user = User::where("username",$username)->first();
       return view("dashboard.profile.index",compact("user"));
    }
}
