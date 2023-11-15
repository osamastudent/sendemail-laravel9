<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>checkout</title>
</head>
<body>
<div class="container">
<h1 class="text-center mt-5">Checkout</h1>
















    <form action="{{route('products.orderdone')}}" method="post">
@foreach($confirmorder as $values)

<p style="display: none;">{{@$totalproqty .=$values->pro_name . '('. $values->pro_quantity .')   '}}</p>
<p style="display: none;">{{@$totalproprice +=$values->pro_quantity * $values->pro_price }}</p>


@endforeach

@if(@$totalproqty)
<p>{{@$totalproqty}}</p>

@else

@endif


@if(@$totalproprice)
<p>{{@$totalproprice}}</p>
@else
@endif
<input type="hidden" name="totalproqty" value="{{@$totalproqty}}">
<input type="hidden" name="totalproprice" value="{{@$totalproprice}}">
<input type="submit" name="" class="btn btn-primary" value="Confirm Order">
@csrf
</form>






</div>    
</body>
</html>