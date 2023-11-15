<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>transaction</title>
</head>
<body>

@if(session('success'))
{{session('success')}}
@endif
<form action="{{ route('processTransaction') }}" method="post">
  @csrf
  <input type="text" name="amount" value="">
  <input type="submit" value="Pay with PayPal">
</form>

</body>
</html>