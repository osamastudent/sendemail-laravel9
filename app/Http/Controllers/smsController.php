<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
class smsController extends Controller
{
   
    public function SmsForm(){
    return view('smsform');
    }



    public function SendSms(Request $request){
      
    
        
        $sid    = env('TWILIO_SID');
        $token  = env('TWILIO_TOKEN');
        $Number  = env('TWILIO_FROM');
        $twilio = new Client($sid, $token);
    
        $message = $twilio->messages->create("+92".$request->number, // to
            array(
              "from" => $Number,
              "body" => $request->message,
            )
          );
    
return "Message Sent!";
         
    // print($message->sid);
    }









    // sened message o whatsapp

    public function Whatsapp(){
         
      $sid    = config('app.TWILIOWID');
    $token  = config('app.TWILIOWTOKEN');
    $TN=config('app.TWILIONUMBER');
    
    $twilio = new Client($sid, $token);
$receivernumer=+923253294825;
$body="sorryi hate you";
    $message = $twilio->messages
      ->create("whatsapp:".$receivernumer, // to
        array(
          "from" => "whatsapp:".$TN,
          "body" =>$body,
        )
      );

print($message->sid);

    }
}
