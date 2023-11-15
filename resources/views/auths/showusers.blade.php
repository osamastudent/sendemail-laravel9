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
<th>active Users</th>
<th>expired Users</th>
<th>pending Users</th>
</thead>

<tbody>

<tr>
<td>{{$usersBeforeCount}}</td>
<td>{{$usersInCurrentMonthCount}}</td>
<td>{{$usersAfterCount}}</td>
</tr>


</tbody>
</table>
</div>
</div>

</div>
</div>   
</body>
</html>