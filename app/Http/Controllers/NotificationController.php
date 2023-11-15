<?php

namespace App\Http\Controllers;

use App\Mail\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\WelcomeNoti;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
   
    
//     public function SendNotification(){
//         $users = User::orderBy('id','desc')->get();
//         $usersData=[
// 'name'=>'osama janab',
// 'url'=>'https://www.youtube.com/watch?v=wNVFE13fgl0&t=25s',
// 'body'=>'this is boody',
// 'regards'=>'sir osama',
//         ];
//  Notification::send($users,new WelcomeNoti($usersData));
//        return "notication sent";
//     }


public function SendNotification(){
return view('noti.notification');
}


public function SendNotificationToUser(Request $request){
$users=User::all(); 

$files = $request->file('myfiles');
    $originalNames = [];

    foreach ($files as $file) {
        $originalNames[] = $file->getClientOriginalName();
        $file->storeAs('public', $file->getClientOriginalName());
    }

   
    // foreach ($files as $file) {
    //     // Store the file in the public directory
    //     $file->storeAs('public', $file->getClientOriginalName());
    // }

// $file=$request->file('myfiles');
// $originalNames=$file->getClientOriginalName();

// Store the file in the public directory
// $file->storeAs('public', $originalName);
// $file->move('images/', $originalNames);

$notiData=[
'name'=>$request->name,
'url'=>$request->url,
'body'=>$request->body,
'myfiles'=>$originalNames,
];

// Notification::send($users,new WelcomeNoti($notiData));

foreach($users as $user){
    Notification::send($users,new WelcomeNoti($notiData));
}




return "Notification Has Sent";
}

}
