<?php

namespace App\Http\Controllers;

use App\Mail\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class mailController extends Controller
{
    public function sendEmailForm(){
        return view('mails.sendemail');
    }


    public function sendEmail(Request $request){
        
Mail::to($request->email)->send(new Orders($request));

return "Sent Email!!";
    }


}
