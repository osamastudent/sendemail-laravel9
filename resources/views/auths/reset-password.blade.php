<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <title>Reset Password</title>
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
<h4>Add User</h4>
</div>

<div class="card-body">
@if(session('status'))
{{session('status')}}
@endif

@if(session('semail'))
session:{{session('semail')}}
@endif

<form action="{{route('password.update')}}" method="post" enctype="multipart/form-data">
    @csrf

<input type="hidden" name="token" value="{{$token}}">


<input type="text" name="email" class="form-control mt-3" placeholder="Email">
@error('email')
{{$message}}
@enderror



<input type="password" name="password" class="form-control mt-3" placeholder="Password">
@error('password')
{{$message}}
@enderror

<input type="password" name="password_confirmation" class="form-control mt-3" placeholder="Confirm Password">
@error('password')
{{$message}}
@enderror


<input type="submit" class="btn btn-primary mt-3" value="Reset Password">
</form>

</div>

 </div>



 </div>   
</body>
</html>