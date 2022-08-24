<?php

namespace App;

class base {
   public static $roles=array("Admin","User","Super user");

   public static function removeSpace($string){
      $string = preg_replace('/\s+/', '', $string);
      return $string;
   }

}