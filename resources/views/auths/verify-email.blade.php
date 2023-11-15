<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>verify-email</title>
</head>
<body>
<div class="container justify-content-center">

<div class="card">
    <p>Email Verification Has Been Sent</p>
<form action="{{route('verification.send')}}" method="post">
    @csrf
    <button type="submit" class="form-control bg-dark text-white">Resend Email Verification</button>
</form>
</div>
</div>
</body>
</html>