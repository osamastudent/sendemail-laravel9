<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <title>Show Users</title>
</head>
<body>
<div class="container">
<a href="/register">register</a>


<div class="card">
<div class="card-header">
<h1>show users</h1>
</div>

<div class="card-body">
<table class="table">
<thead>
<th>Index</th>
<th>name</th>
<th>Email</th>
<th>Mobile_no</th>
</thead>

<tbody>

@foreach($users as $values)
<tr>
<td>{{ $loop->iteration }}</td>
<h1><a href="/slug/{{$values->name}}"><h1>{{$values->name}}</h1></a></h1>
<td>{{$values->email}}</td>

<td>{{$values->mobile_no}}</td>
</tr>

@endforeach

</tbody>
</table>
</div>
</div>

</div>
</div>   
</body>
</html>