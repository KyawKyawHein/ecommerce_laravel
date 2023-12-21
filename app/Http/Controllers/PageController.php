<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get limit category
        // $categories = Category::inRandomOrder()->limit(4)->get();
        // $category1 = $categories[0];
        // $category2 = $categories[1];
        // $category3 = $categories[2];
        // $category4 = $categories[3];
        $categories = Category::with(['products' => function ($query) {
    $query->inRandomOrder()->limit(1);
}])->get();
        return $categories;
        $products = Product::latest('id')->with('category')->paginate(10); 
        return view('user.home',compact('categories','products'));
    }

   public function detail(string $slug){
        $product= Product::where('slug',$slug)->first();
        return view('user.detail',compact('product'));
   }
}
