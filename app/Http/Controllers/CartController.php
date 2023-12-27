<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index(){
        $products = auth()->user()->products;
        return view('user.add-to-cart',compact('products'));
    }

    //add to Cart
   public function addToCart(Request $request){
        $cart = auth()->user()->products()->syncWithoutDetaching([
            $request->product_id=>['quantity'=>$request->quantity]
        ]);
        $currentItemQuantity = auth()->user()->products()->where('product_id',$request->product_id)->first()->pivot->quantity;
        $cartCount = auth()->user()->products()->count();
        return response(['currentItemQuantity'=>$currentItemQuantity,'cartCount'=>$cartCount]);
   }

   public function increaseQuantity(Request $request){
        $product = auth()->user()->products()->where('id',$request->product_id)->first();
        if($product){
            $quantity = $product->pivot->quantity +1;
            if($quantity >$product->stock_quantity){
                return response(['error'=>"Stock has only ".$product->stock_quantity." left."],422);
            }else{
                auth()->user()->products()->syncWithoutDetaching([
                    $request->product_id=>['quantity'=>$quantity]
                ]);
                $totalAmount  = auth()->user()->products->sum(fn($p)=>($p->price*$p->pivot->quantity));
                return response([
                    'quantity'=>$quantity,
                    'totalAmount'=>$totalAmount
                ]);
            }
        }else{
            return response(['error'=>'Not Found'],404);
        }

   }
    public function decreaseQuantity(Request $request){
        $product = auth()->user()->products()->where('id',$request->product_id)->first();
        if($product){
            $quantity = $product->pivot->quantity -1;
            if($quantity<1){
                return response(['error'=>"Product must have 1."],422);
            }else{
                auth()->user()->products()->syncWithoutDetaching([
                    $request->product_id=>['quantity'=>$quantity]
                ]);
                $totalAmount  = auth()->user()->products->sum(fn($p)=>($p->price*$p->pivot->quantity));
                return response([
                    'quantity'=>$quantity,
                    'totalAmount'=>$totalAmount
                ]);
            }
        }else{
            return response(['error'=>'Not Found'],404);
        }
    }

    public function removeProduct(Request $request){
        $product= auth()->user()->products()->where('id',$request->product_id)->first();
        if(!$product){
            return response(['error'=>"Product not found."],404);
        }else{
            auth()->user()->products()->detach($request->product_id);
            $totalAmount  = auth()->user()->products->sum(fn($p)=>($p->price*$p->pivot->quantity));
            return response([
                'totalAmount'=>$totalAmount
            ]);
        }
    }
}
