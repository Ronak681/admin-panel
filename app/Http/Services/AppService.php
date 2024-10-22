<?php
namespace App\Http\Services;
use Str;

class AppService {
   public function CreateToken($length){
    $token = Str::random($length);
    return $token;
    
   }
}