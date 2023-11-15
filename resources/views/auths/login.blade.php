<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <title>Login</title>
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
<h4>Login Form</h4>
@if(session('failed'))
{{session('failed')}}

@elseif(session('status'))
{{session('status')}}
@endif

</div>

<div class="card-body">





<form action="{{route('LoginUser')}}" method="post" enctype="multipart/form-data">
    @csrf
   


<input type="text" name="email" class="form-control mt-3" placeholder="Email">
@error('email')
{{$message}}
@enderror

<!-- <input type="text" name="otp" class="form-control mt-3" placeholder="otp">
@error('otp')
{{$message}}
@enderror -->

<input type="password" name="password" class="form-control mt-3" placeholder="Password">
@error('password')
{{$message}}
@enderror

<input type="checkbox" id="remember" name="remember" class="mt-3">
<label for="remember">Remember Me</label> <br>
<input type="submit" class="btn btn-primary mt-3" value="Login">
<span  class="mt-5"><a href="{{route('password.request')}}">Forgot Password</a></span>
</form>

</div>

 </div>



 </div>   
</body>
</html>