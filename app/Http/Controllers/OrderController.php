<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(){
        $orders = auth()->user()->orders;
        return view('user.orders',compact('orders'));
    }

    public function addOrder(Request $request){
        $products = auth()->user()->products;
        foreach($products as $product){
            Order::create([
                "user_id"=>auth()->id(),
                "product_id"=>$product->id,
                "quantity"=>$product->pivot->quantity,
                "address"=>$request->user()->address
            ]);
            auth()->user()->products()->detach($product->id);
        }
        return redirect('/')->with('success',"Order makes successfully.");
    }

    public function accountDetail(){

    }
}
