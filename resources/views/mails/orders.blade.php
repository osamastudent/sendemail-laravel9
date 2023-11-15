<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        
.container{
    max-width: 600px;
    width: 600px;
}
    </style>

</head>
<body>
    




<div class="container p-5">
<div class="card text-center">
<div class="card-title p-3 ">
<h3>This is Title</h3>
<h2>{{$name}}</h2>
</div>
<img src="{{asset('osama.jpeg')}}" class="card-img-top mx-auto w-75" height="250" alt="osama">
<div class="card-body ">
<p><b>{{$mymessage}}</b></p>    
<p>Lorem Nesciunt nisi vitae doloribus voluptatem delectus quis officia sapiente, dicta et, quod eum culpa ab repudiandae eos minus! Molestias, debitis consectetur dolorem veniam tempora tenetur amet a deserunt. Nostrum, odit!</p>

</div>
</div>
</div>
</body>
</html>