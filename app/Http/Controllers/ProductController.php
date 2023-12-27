<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentCategory;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;


class ProductController extends Controller
{
    public function productsByCategory(string $parentCategory,string $category){
        $parentCategoryId = ParentCategory::where('slug',$parentCategory)->first()->id;
        $category = Category::where('parent_category_id',$parentCategoryId)->where('slug',$category)->first();
        $products  = Product::where('category_id',$category->id);
        if(request('search')){
            $products = $products->where('name',"LIKE",'%'.request('search').'%');
        };
        return view('user.products-by-category',[
            "products" =>$products->paginate(6),
            "category"=>$category
        ]);
   }

    public function detail(string $slug){
        $product= Product::where('slug',$slug)->with(['category'])->first();
        $randomProducts= Product::where('category_id',$product->category->id)->where('id','!=',$product->id);
        if(request('search')){
            $randomProducts= $randomProducts->where('name','LIKE',"%".request('search')."%");
        };
        //get quantity when the item is add to cart
        if(!auth()->user()){
            $productCountFromCart  =0;
        }else{
            $p = auth()->user()->products()->where('product_id',$product->id);
            if($p->first()){
                $productCountFromCart  =$p->first()->pivot->quantity;
            }else{
                $productCountFromCart  =0;
            };
        }

        return view('user.detail',[
            "product"=>$product,
            "randomProducts"=>$randomProducts->paginate(6),
            "productCountFromCart"=>$productCountFromCart
        ]);
    }
}
