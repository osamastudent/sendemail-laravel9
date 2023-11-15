<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <title>OTP</title>
</head>
<body>
 <div class="container">
 
 
 <h1></h1>
 <a href="/category">Category</a>
<a href="/showproducts">showproducts</a>
<a href="/register">register</a>
<a href="/login">login</a>

<div class="card">
<div class="card-header">
<h4>Verify  OTP</h4>
@if(session('failed'))
{{session('failed')}}

@elseif(session('status'))
{{session('status')}}
@endif
<b>Your Otp will be expired in 1 minute: </b><span class="text-center" id="demo"></span>
</div>


<div class="card-body">

@if(session('userid'))
{{$userid=session('userid')}}
@endif



<form action="{{route('otpVerify')}}" method="post" enctype="multipart/form-data">
    @csrf
   

<input type="hidden" name="userid" value="{{$userid}}">
<input type="text" name="otp"  class="form-control mt-3" placeholder="Enter Your OTP">
@error('otp')
{{$message}}
@enderror



<input type="submit" class="btn btn-primary mt-3" value="Verify">

</form>
<h5 id="show"></h5>
</div>

 </div>

 <div>Time left = <span id="timer">@if(session('expire_at'))
{{session('expire_at')}}
 @endif
</span>
<h5 id="show"></h5>
</div>
<!-- Display the countdown timer in an element -->
<script>
function callMyCount() {
  var timerElement = document.getElementById('timer');
  var expireTime = 10; // Set the timer duration in seconds
  var currentTime = expireTime;

  timerElement.textContent = formatTime(currentTime);

  var myTimer = setInterval(function () {
    currentTime--;
    timerElement.textContent = formatTime(currentTime);

    if (currentTime <= 0) {
      clearInterval(myTimer);
      // alert("Timeout for otp");
      document.getElementById("show").innerHTML="Your OTP has expired";
    }
  }, 1000);

  function formatTime(time) {
    var minutes = Math.floor(time / 60);
    var seconds = time % 60;
    return (minutes < 10 ? "0" : "") + minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
  }
}

// Automatically start the timer when the page loads
document.addEventListener("DOMContentLoaded", function () {
callMyCount();
});
</script>

</html>

</div>   
</body>
</html>