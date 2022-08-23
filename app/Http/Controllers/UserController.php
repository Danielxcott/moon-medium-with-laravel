<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
