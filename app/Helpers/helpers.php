<?php 
use App\Models\User;
use App\Models\NoaMessages;

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

 if(!function_exists('getUserUnreadMessages')){
    function getUserUnreadMessages(int $user_id, int $sender_id){
        $unread = NoaMessages::where([['from_id', $sender_id],['to_id', $user_id], ['seen', 0]])->count();
         return $unread;
     }
 }
 
