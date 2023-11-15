<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.tutorialjinni.com/intl-tel-input/17.0.19/css/intlTelInput.css"/>
<script src="https://cdn.tutorialjinni.com/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>

    <title>SMS</title>
</head>
<body>
<div class="container">
<div class="card mt-5">
<div class="card-header">
<h1>Send SMS</h1>
<span>copy: 03472737876 -->  03253294825</span>
</div>
<div class="card-body">
<form action="{{route('SendSms')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input name="number" type="text"  id="phone"  class="form-control mt-3"/> 


    <span id="phone-validation-feedback"></span>
    @error('number')
{{$message}}
    @enderror

    
    <input type="text" name="message" class="form-control mt-3" autocomplete="off"  placeholder="message">
    <input type="submit" name="" value="Send Data" class="btn btn-danger mt-3">
</form>
</div>
</div>
<h1><a href="https://wa/923412804405" target="_blank">whatsapp</a></h1>
</div>

<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
        separateDialCode: true,
        excludeCountries: ["il"],
        preferredCountries: ["ru", "jp", "pk", "no", "in", "us", "ca", "uk", "au"]
    });
</script>


</body>
</html>
