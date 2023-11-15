<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>showaddtocart</title>
</head>
<body>
<div class="container">

@if($cart)
<h1>cart:{{$cart}}</h1>
@else

@endif
<table class="table mt-5">
<thead>
<th>Index</th>
<th>Product Name</th>
<th>Quantity</th>
<th>Product Price</th>
<th>Total</th>
<th>Product Image</th>
</thead>

<tbody>
    <form action="{{route('products.confirmorders')}}" method="post">
@foreach($showaddtocart as $values)
<tr>

<td>{{$loop->iteration}}</td>
<td>{{$values->name}}</td>
<td>{{$values->quantity}}</td>
<td>{{$values->price}}</td>
<td><b>{{$total=$values->quantity * $values->price}}</b></td>

<td style="display: none;"><b>{{@$finalamount+=$values->quantity * $values->price}}</b></td>
<td><img src="{{$values->image}}" height="50"></td>
   


</tr>

<input type="hidden" name="pro_name[]" value="{{$values->name}}">
<input type="hidden" name="pro_quantity[]" value="{{$values->quantity}}">
<input type="hidden" name="pro_price[]" value="{{$values->price}}">
<input type="hidden" name="total[]" value="{{$total}}">
@endforeach


</tbody>
</table>
<td><h5>Your Total Amount Is:{{$finalamount}}</h5></td> 
<input type="submit" name="" class="btn btn-primary" value="proceed to checkout">
@csrf
</form>
</div>    
</body>
</html>