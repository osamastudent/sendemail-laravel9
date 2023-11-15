<?php

namespace App\Http\Controllers;

use App\Models\addtocart;
use App\Models\checkout;
use App\Models\confirmorder;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class addtocartController extends Controller
{
    
public function showProducts(){
$showProducts=Product::all();
return view('products.Products',compact('showProducts'));
}



// addtocart
public function addtocart(Request $request){
$addtocart=$request->all();
$addtocart['user_id']=Auth::id();

addtocart::create($addtocart);
return back();

}


public function showaddtocart(){
    $showaddtocart=addtocart::all();
    $user=Auth::user();
    $cart=addtocart::where('user_id',$user->id)->count();
    return view('products.showaddtocart',compact('showaddtocart','cart'));
    
    }



    public function Cart(){
    $user=Auth::user();
    $email=$user->email;
    $cart=addtocart::where('user_id',$user->id)->count();
        return view('products.showaddtocart',compact('cart'));
    }


// /chekout
public function confirmorder(Request $req){

    $user=Auth::user();
    $name=$user->name;
    $phone=$user->mobile_no;
    $email=$user->email;
    foreach($req->pro_name as $key=> $pro_name){
    $obj=new confirmorder();

$obj->user_name=$name;
$obj->user_phone=$phone;
$obj->user_email=$email;
$obj->pro_name=$req->pro_name[$key];
$obj->pro_quantity=$req->pro_quantity[$key];
$obj->pro_price=$req->pro_price[$key];
$obj->total_price=$req->total[$key];
$obj->status="pending";
$obj->save();
    }
addtocart::where('user_id',$user->id)->delete();
return redirect('checkout');
}



public function Checkout(){
$confirmorder=confirmorder::all();
return view('products.checkout',compact('confirmorder'));
}

public function orderdone(Request $request){

$user=Auth::user();
$obj=new checkout();
$obj->name=$user->name;
$obj->email=$user->email;
$obj->phone=$user->mobile_no;
$obj->total_product=$request->totalproqty;
$obj->total_price=$request->totalproprice;
$obj->save();
confirmorder::where('user_email',$user->email)->delete();
return back();
}
}
