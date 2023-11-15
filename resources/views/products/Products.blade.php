<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Products</title>
</head>
<body>
<div class="container">
<div class="row">
@foreach($showProducts as $values)
<div class="col-md-4 text-center">


<div class="card mt-5" style="width: 18rem;">
<img src="{{$values->image}}" alt="">
  <div class="card-body">
    <h5 class="card-title">{{$values->name}}</h5>
    <p class="card-text">{{$values->price}}</p>
    <p class="card-text">{{$values->description}}</p>

    <form action="{{route('products.addtocart')}}" method="post">
    @csrf
    <input type="hidden" name="name" value="{{$values->name}}">
    <input type="hidden" name="price" value="{{$values->price}}">
    <input type="hidden" name="description" value="{{$values->description}}">
    <input type="hidden" name="image" value="{{$values->image}}">
    <input type="number" name="quantity" id="" placeholder="quantity">
    <input type="submit" name="" value="Addtocart" class="btn btn-primary">
    </form>
  </div>
</div>


</div>
@endforeach
</div>
</div>    
</body>
</html>