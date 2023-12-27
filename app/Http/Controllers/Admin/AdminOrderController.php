<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{
    public function index(){
        $orders = Order::latest('id')->with('product')->paginate(5);
        return view('admin.order.index',compact('orders'));
    }

    public function makeComplete(string $id){
        $order = Order::find($id);
        $order->update([
            'status'=> 'complete'
        ]);
        return redirect()->back()->with('success','Make completed.');
    }

    public function showPending(){
        $orders = Order::where('status','pending')->paginate(5);
        return view('admin.order.index',compact('orders'));
    }
    public function showComplete(){
        $orders = Order::where('status','complete ')->paginate(5);
        return view('admin.order.index',compact('orders'));
    }
}
