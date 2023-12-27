<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ParentCategory;
use App\Models\Cart;
use App\Models\Banner;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::inRandomOrder()->limit(16)->get();
        $categoriesWithRandomProduct = Product::getRandomProductByCategories($categories);
        $banners = Banner::where('expire_date','>',now())->get();
        // get products with search query
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $products = Product::where('name',"LIKE","%$search%")->paginate(10);
        }else{
            $products = Product::latest('id')->with('category')->paginate(10);
        }
        return view('user.home',compact('categoriesWithRandomProduct','products','banners'));
    }

    public function billing(){
        return view('user.billing');
    }
    public function postBilling(){

    }
}
