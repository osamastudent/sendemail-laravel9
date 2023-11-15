<?php

use App\Mail\Orders;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\smsController;
use App\Http\Controllers\mailController;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\addtocartController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\markdowntemplateController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('verified');


Route::get('home', function () {
    return "Dashboard";
})->name('home');

Route::get('register', [CategoryController::class, 'Register'])->name('Register');
Route::post('register', [CategoryController::class, 'RegisterStore'])->name('RegisterStore');
Route::get('login', [CategoryController::class, 'Login'])->name('Login');
Route::post('login', [CategoryController::class, 'LoginUser'])->name('LoginUser');

Route::get('logout', [CategoryController::class, 'Logout'])->name('Logout');



Route::get('/email/verify', function () {
    return view('auths.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    $user=new User();
    $user = $request->user();
    $user->update(['verified_at' => now()]);
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    date_default_timezone_set("asia/karachi");
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// forgot password


Route::get('/forgot-password', function () {
    return view('auths.forgot-password');
})->name('password.request');


Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->name('password.email');


Route::get('/reset-password/{token}', function ($token) {
    return view('auths.reset-password', ['token' => $token]);
})->name('password.reset');




Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('Login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->name('password.update');



// send email

Route::get('/email',function(){
    $name='hassas';
    $mymessage="who are you";
return new Orders($name,$mymessage);
});



Route::get('/email-send',function(){
    $name='my name is osama';
    $mymessage="how are you osama bhai";
    Mail::to('osamajanab9999@gmail.com')->send(new Orders($name,$mymessage));
    return "email sent successfuly";
    });







// send data using form

// Route::get('sendemail',function(){
// return view('mails.sendemail');
//     });


//     Route::post('/sendemail',function(Request $request){
       
//         Mail::to($request->email)->send(new Orders($request));
//         return "email sent";
//         })->name('sendEmail');



route::get('sendemail',[mailController::class,'sendEmailForm']);
route::post('sendemail',[mailController::class,'sendEmail'])->name('sendEmail');


// markdown template

route::get('markdowntemplate',[markdowntemplateController::class,'markdownTemplate']);
route::post('markdowntemplate',[markdowntemplateController::class,'markdownTemplatesendemail'])->name('markdownTemplatesendemail');




// send notification

Route::get('/sendnotification',[NotificationController::class,'SendNotification']);
Route::post('/sendnotification',[NotificationController::class,'SendNotificationToUser'])->name('SendNotificationToUser');

// send sms usig twilio

Route::get('/sendsms',[smsController::class,'SmsForm']);
Route::post('/sendsms',[smsController::class,'SendSms'])->name('SendSms');

// using whatsapp
Route::get('/whatsapp',[smsController::class,'Whatsapp']);



// otp login

Route::get('/otp',[CategoryController::class,'otpForm']);
Route::post('/otp',[CategoryController::class,'otpVerify'])->name('otpVerify');
Route::get('/showusers',[CategoryController::class,'showUsers']);


Route::get('/show',[CategoryController::class,'Show']);

Route::get('/slug/{slug:name}',[CategoryController::class,'Slug']);

// second method
// Route::get('/slug/{slug}',[CategoryController::class,'Slug']);



Route::get('/form',[StripeController::class,'Form']);



Route::get('/products',[addtocartController::class,'showProducts'])->name('products.showProducts');
Route::post('/addtocart',[addtocartController::class,'addtocart'])->name('products.addtocart');
Route::get('/showaddtocart',[addtocartController::class,'showaddtocart'])->name('products.showaddtocart');
Route::post('/confirmorder',[addtocartController::class,'confirmorder'])->name('products.confirmorders');
Route::get('/checkout',[addtocartController::class,'Checkout'])->name('products.checkout');
Route::post('/orderdone',[addtocartController::class,'orderdone'])->name('products.orderdone');




// paypal;
Route::get('/paypal',function(){
    return view('myOrder');
});

// route for processing payment
Route::post('/paypal',[StripeController::class,'pay'])->name('stripe.pay');
Route::post('/paypal', [PaypalController::class, 'payWithpaypal'])->name('paypal');

// route for check status of the payment
Route::get('/status', [PaypalController::class, 'getPaymentStatus'])->name('status');


// https://www.youtube.com/watch?v=sZMv4y_eEBU




   Route::view('/index','index')->name('index');
	
   Route::post('/pay',[paymentController::class,'pay'])->name('payment');

   Route::get('/success',[paymentController::class,'success']);

   Route::get('/error',[paymentController::class,'error']);

   Route::view('/pageFail','paymentFail')->name('pageFail');

   Route::view('/pageSuccess','success')->name('pageSuccess');




Route::get('create-transaction', [PaypalController::class, 'createTransaction'])->name('createTransaction');
Route::post('process-transaction', [PaypalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PaypalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PaypalController::class, 'cancelTransaction'])->name('cancelTransaction');