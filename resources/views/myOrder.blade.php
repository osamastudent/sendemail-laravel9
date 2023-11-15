<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <title>Paypal</title>
</head>
<body>
    
<div class="container">
<h4>I want to pay 768 USD</h4>
<form method="post" action="{{route('paypal')}}" >
    @csrf
   <input type="text" name="amount" value="{{old('amount')}}"> 
   <input type="submit" name="paynow" value="Pay Now">
</form>
</div>
</body>
</html>