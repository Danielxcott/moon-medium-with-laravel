<?php

namespace App;

use App\Models\UserRequest;
use Illuminate\Support\Facades\Auth;

class base {
   public static $roles=array("Admin","User","Super user");

   public static $reportMessages = array("Spam","False Information","Harassment");
   
   public static $gender = array("Non-selected","admin","user");
   
   public static function removeSpace($string){
      $string = preg_replace('/\s+/', '', $string);
      return $string;
   }
   public static function specificUser($user)
   {
      $specificUser =  UserRequest::Where("friend_id",Auth::id())->where("user_id",$user->id)->where("status","0")->first();
      return $specificUser;
   }
   public static function confirm($user)
   {
      $confirm =  UserRequest::Where("friend_id",Auth::id())->where("user_id",$user->id)->where("status","1")->first();
      return $confirm;
   }
   public static function generateTime($date)
   {
      return date('Y-m-d',strtotime($date));
   }
}