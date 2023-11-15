<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Payment</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
	<style type="text/css">

    body
    {
        background:#f2f2f2;
    }

    .payment
	{
		border:1px solid #f2f2f2;
		height:226px;
        border-radius:20px;
        background:#fff;
	}
   .payment_header {
    background: rgba(255,102,0,1);
    padding: 10px 14px 6px 14px;
    border-radius: 20px 20px 0px 0px;
}
   
   .check
   {
	   margin:0px auto;
	   width:50px;
	   height:50px;
	   border-radius:100%;
	   background:#fff;
	   text-align:center;
   }
   
   .check i
   {
	   vertical-align:middle;
	   line-height:50px;
	   font-size:30px;
   }

    .content 
    {
        text-align:center;
    }

    .content  h1
    {
        font-size:25px;
        padding-top:25px;
    }

    .content a
    {
        width:200px;
        height:35px;
        color:#fff;
        border-radius:30px;
        padding:5px 10px;
        background:rgba(255,102,0,1);
        transition:all ease-in-out 0.3s;
    }

    .content a:hover
    {
        text-decoration:none;
        background:#000;
    }
   input{
   	width: 95%;
    margin-top: 40px;
    border: 2px solid #e9e5e5;
    border-radius: 6px;
    padding: 5px 13px
   }
   button{
   	width: 95%;
    margin-top: 9px;
    background: #FFC439;
    border: none;
    border-radius: 25px;
    padding: 8px;
   }
</style>
</head>
<body>
	<div class="container">
   <div class="row">
      <div class="col-md-6 mx-auto mt-5">
         <div class="payment">
            <div class="payment_header">
               	<h2 style="color: white; font-size: 24px;
    letter-spacing: 1px;
    font-weight: 700;"> Payment With PayPal </h2>
            </div>
            <div class="content">
               <form action="{{route('payment')}}" method="post">
					@csrf
					<input type="text" name="amount" placeholder="Amount">
					<button type="submit">Paypal</button>
				</form>
            </div>
         </div>
      </div>
   </div>
</div>
</body>
</html>
