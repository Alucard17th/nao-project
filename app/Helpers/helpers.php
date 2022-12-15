<?php 
use App\Models\User;

if(!function_exists('appendText')){
   function appendText(int $id = null){
        $user = User::where('id', $id)->first();
        return $user;
    }
}

if(!function_exists('getAllUsersName')){
    function getAllUsersName(array $ids = null){
        foreach ($ids as $value) {
            $user[] = User::where('id', $value)->first();
        }
         
         return $user;
     }
 }
 
