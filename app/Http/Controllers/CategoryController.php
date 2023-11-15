<?php

namespace App\Http\Controllers;


use queue;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserOtp;
use Twilio\Rest\Client;
use App\Models\category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CategorRequest;
use App\Mail\SendOtp;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Session\Session as SessionSession;

use function PHPUnit\Framework\isEmpty;

class CategoryController extends Controller
{


    // Register

    public function Register()
    {
        return view('auths.register');
    }

    public function RegisterStore(Request $request)
    {


        date_default_timezone_set("asia/karachi");


        $user = $request->all();
        $user['password'] = Hash::make($request->password);
        $usercreated = User::create($user);

        // $UserOtp=new UserOtp();
        // if($usercreated){
        // $UserOtp->user_id=$usercreated->id;
        // $UserOtp->otp=rand(1000,5000);
        // }
        // $UserOtp->save();
$otpsend=rand(1000,5000);

    Mail::to($request->email)->send(new SendOtp($otpsend));



        //         $sid    = config('app.TWILIOSID');
        //     $token  = config('app.TWILIOTOKEN');
        //     $twilioNumber= config('app.TWILIOFROM');
        //     $receiveNumber=3472737876;
        //     $twilio = new Client($sid, $token);

        //     $message = $twilio->messages
        //       ->create("+92".$receiveNumber, // to
        //         array(
        //           "from" => $twilioNumber,
        //           "body" =>"Your OTP is:". $UserOtp->otp=rand(1000,5000),
        //         )
        //       );
        // return "Message Sent!";

        Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        event(new Registered($user));
        return redirect('/');
    }





    public function otpForm()
    {
        return view('auths.otp');
    }


    public function otpVerify(Request $request)
    {
        $userId = $request->userid;
        $otp = $request->otp;

        // $user = UserOtp::where('user_id',$userId)->first();
        $UserOtp = UserOtp::where('user_id', $userId)->where('otp', $otp)->first();

        $now = now();
        if (!$UserOtp) {
            return back()->with('status', 'Your Otp Is incorrect if condition run');
        } 
        elseif ($UserOtp && $now->isAfter($UserOtp->expire_at)) {
            return back()->with('status', 'Your Otp has expired elseif condition run');
        }

        $user = User::whereId($request->userid)->first();

        if ($user) {
            $UserOtp->update([
                'expire_at' => now(),
            ]);
            Auth::login($user);
            return redirect('/');
        }

        return redirect('/login')->with('status',"your otp is invalid");

        // $userOtp = UserOtp::where('otp', $request->otp)->first();

        // if ($userOtp) {
        //     // OTP is correct, you can proceed with authenticating the user
        //     // For example, you can use Auth::login($userOtp->user) to log in the user
        //     Auth::login($userOtp->user);
        //     return redirect('/'); // Replace with your desired dashboard route
        // } else {
        //     // Invalid OTP, redirect back to OTP verification page
        //     return redirect()->back()->with('status', 'Invalid OTP. Please try again.');
        // }
    }


    // Login

    public function Login()
    {
        return view('auths.login');
    }


    public function loginUser(Request $request)
    {
        $remember = $request->remember;
        $user = Auth::user();
        $credentials = $request->only('email', 'password');
        $remember = $request->remember;
        if (Auth::attempt($credentials, $remember)) {

            $now = now(); // Current datetime
            $UserOtp = new UserOtp();
            if ($credentials) {
                $UserOtp->user_id = $user->id;
                $UserOtp->otp = rand(1000, 5000);
                $UserOtp->expire_at = $now->addMinutes(1);
            }
            $UserOtp->save();
    // $sid    = config('app.TWILIOSID');
    //         $token  = config('app.TWILIOTOKEN');
    //         $twilioNumber= config('app.TWILIOFROM');
    //         $receiveNumber=3472737876;
    //         $twilio = new Client($sid, $token);

    //         $message = $twilio->messages
    //           ->create("+92".$receiveNumber, // to
    //             array(
    //               "from" => $twilioNumber,
    //               "body" =>"Your OTP is:". $UserOtp->otp,
    //             )
    //           );


            // Authentication successful
            $expire_at=$UserOtp->expire_at;
            session()->put('email', $request->email);
            $userid = Auth::id();
            session()->put('userid', $userid);
            return redirect('/otp');
            // return view('auths.otp', compact('userid','expire_at')); // Redirect to the product page after successful login
        }

        // Check if the email exists in the database
        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            // Password is incorrect
            return back()->with('status', 'Password is not matching');
        } else {
            // User is not registered
            return back()->with('status', 'User is not registered');
        }





        //    $user = User::where('email', $request->email)->first();

        // if (!$user) {
        //     return back()->with('status', "The User Is Not Registered");
        // }

        // $userOtp = UserOtp::where('user_id', $user->id)->first();

        // if (!$userOtp) {
        //     return back()->with('status', "No OTP found for this user.");
        // }

        // if ($userOtp->otp === $request->otp) {
        //     // OTP is correct, proceed with authentication
        //     Auth::login($user);

        //     return redirect('/'); // Redirect to the desired page after successful login
        // } else {
        //     return back()->with('status', 'Incorrect OTP. Please try again.');
        // }


        // $user = User::where('email', $request->email)->first();

        // if ($user) {
        //     if (password_verify($request->password, $user->password)) {
        //         session()->put('email', $request->email);
        //         return redirect()->route('ShowProduct');
        //     } else {
        //         return back()->with('status', 'Password and email do not match');
        //     }
        // } else {
        //     return back()->with('status', 'The user is not registered');
        // }




        // if ($user) {
        //     if (password_verify($request->password, $user->password)) {
        //          if ($remember) {
        //             $rememberToken = Str::random(60); // Generate a random remember token
        //             $user['remember_token']=$rememberToken;
        //             $user->save();
        //             Cookie::queue('email',$request->email);
        //                 }
        //         session()->put('email', $request->email);

        //         return redirect()->route('ShowProduct');
        //     }
        //      else {
        //         return back()->with('status', 'Password and email do not match');
        //     }
        // } else {
        //     return back()->with('status', 'The user is not registered');
        // }




        // $credentials = $request->only('email', 'password');
        // $remember = $request->remember;
        // if (Auth::attempt($credentials, $remember)) {
        //     // Authentication successful
        //     Session()->put('email', $request->email);
        //     return redirect('/'); // Redirect to the product page after successful login
        // }

        // // Check if the email exists in the database
        // $user = User::where('email', $credentials['email'])->first();

        // if ($user) {
        //     // Password is incorrect
        //     return back()->with('status', 'Password is not matching');
        // } else {
        //     // User is not registered
        //     return back()->with('status', 'User is not registered');
        // }
    }


    // logout
    public function Logout()
    {
        if (Session('email')) {
            Session()->flush('email');
        }
        return redirect('/login');
    }


    // public function Layout()
    // {
    //     $semail = session()->get('email');
    //     return view('layout', compact('semail'));
    // }

    public function DeleteCoookie()
    {

        Cookie::queue(Cookie::forget('email'));

        return back();
    }



    public function showUsers(){
  
        // $currentYear = Carbon::now()->year;
        // $currentMonth = Carbon::now()->month;

        // $usersBeforeCurrent = User::whereYear('created_at', '<', $currentYear)
        //     ->orWhere(function ($query) use ($currentYear, $currentMonth) {
        //         $query->whereYear('created_at', $currentYear)
        //             ->whereMonth('created_at', '<', $currentMonth);
        //     })
        //     ->get();

        // $usersInCurrent = User::whereYear('created_at', $currentYear)
        //     ->whereMonth('created_at', $currentMonth)
        //     ->get();

        // $usersAfterCurrent = User::whereYear('created_at', '>', $currentYear)
        //     ->orWhere(function ($query) use ($currentYear, $currentMonth) {
        //         $query->whereYear('created_at', $currentYear)
        //             ->whereMonth('created_at', '>', $currentMonth);
        //     })
        //     ->get();


//         $currentMonth = Carbon::now()->month;
//         $usersBeforeCurrentMonth = User::whereMonth('created_at', '<', $currentMonth)->get();
//         $usersInCurrentMonth = User::whereMonth('created_at', '=', $currentMonth)->get();
//         $usersAfterCurrentMonth = User::whereMonth('created_at', '>', $currentMonth)->get();


//         $usersBeforeCurrentMonthCount = $usersBeforeCurrentMonth->count();
// $usersInCurrentMonthCount = $usersInCurrentMonth->count();
// $usersAfterCurrentMonthCount = $usersAfterCurrentMonth->count();

// echo 'Users created before the current month: ' . $usersBeforeCurrentMonthCount . '<br>';
// echo 'Users created in the current month: ' . $usersInCurrentMonthCount . '<br>';
// echo 'Users created after the current month: ' . $usersAfterCurrentMonthCount . '<br>';


// $usersBeforeCurrentCount=$usersBeforeCurrent->count();
// echo 'Users created before the current month: ' . $usersBeforeCurrentCount . '<br>';




// Get the current month and year.
$currentMonth = now()->month;
$currentYear = now()->year;

// Query for users created before the current month and year.
$usersBefore = User::whereDate('created_at', '<', Carbon::create($currentYear, $currentMonth, 1))->get();

// Query for users created in the current month and year.
$usersInCurrentMonth = User::whereDate('created_at', '>=', Carbon::create($currentYear, $currentMonth, 1))
    ->whereDate('created_at', '<', Carbon::create($currentYear, $currentMonth + 1, 1))->get();

// Query for users created after the current month and year.
$usersAfter = User::whereDate('created_at', '>=', Carbon::create($currentYear, $currentMonth + 1, 1))->get();

// $usersAfter=User::where('email_verified_at',null)->get();

// Count the number of users in each query result.
$usersBeforeCount = $usersBefore->count();
$usersInCurrentMonthCount = $usersInCurrentMonth->count();
$usersAfterCount = $usersAfter->count();

// Display the counts to the user.
echo 'Users created before the current month and year: ' . $usersBeforeCount . '<br>';
echo 'Users created in the current month and year: ' . $usersInCurrentMonthCount . '<br>';
echo 'Users created after the current month and year: ' . $usersAfterCount . '<br>';



        return view('auths.showusers',compact('usersBeforeCount', 'usersInCurrentMonthCount', 'usersAfterCount'));
    }



    public function Show(){
    $users=User::all();
    return view('slug.show',compact('users'));
    }



    public function Slug(User $slug){
    return view('slug.slug',compact('slug'));
    }
}
