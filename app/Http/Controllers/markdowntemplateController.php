<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
class markdowntemplateController extends Controller
{
    public function markdownTemplate(){
       
        return view('emails.orders.shippedform');
    }

    public function markdownTemplatesendemail(Request $request){
        $usersData=User::all();
        
    Mail::to($request->email)->send(new OrderShipped($request,$usersData));
    return "email sent using markdown";
    }
}
