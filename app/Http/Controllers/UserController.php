<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
   public function index()
   {
    $currentUser = Auth::id();
    $user = User::where("id",$currentUser)->first();
    return view("dashboard.profile.index",compact("user"));
   }

   public function create()
   {
    return ;
   }

   public function edit(User $user)
   {
        Gate::authorize("view",$user);
        return view("dashboard.profile.edit",compact("user"));
   }

   public function update(User $user, UpdateUserRequest $request)
   {
      Gate::authorize("update",$user);
      request()->validate([
         "username" => ["required","min:3",Rule::unique("users","username")->ignore($user->id)],
      ]);
      $user->name = $request->name;
      if(isset($request->username))
      {
         $user->username = $request->username;
      }
      $user->username = $user->username;
      $user->gender = $request->gender;
      $user->role = $user->role;
      $user->isBanned = $user->isBanned;
      $user->email = $request->email;
     if(isset($request->bio))
     {
      $user->bio = $request->bio;
     }else{
      $user->bio = null;
   }
     $user->livein = $request->livein;
     $user->mobile = $request->mobile;
     $user->update();
     if($request->hasFile("profile"))
     {
      Storage::delete('public/profile/'.$user->profile);
      $newname = uniqid()."profile.".$request->file("profile")->extension();
      $request->file("profile")->storeAs("public/profile",$newname);
      $user->profile = $newname;
      $user->update();
     }
     if($request->hasFile("cover_img"))
     {
      Storage::delete('public/cover/'.$user->cover_img);
      $newname = uniqid()."cover.".$request->file("cover_img")->extension();
      $request->file("cover_img")->storeAs("public/cover",$newname);
      $user->cover_img = $newname;
      $user->update();
     }
      return redirect()->route("index.profile");
   }
}
