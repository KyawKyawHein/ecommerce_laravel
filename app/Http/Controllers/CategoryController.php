<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ParentCategory;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index(string $slug=null){
        if(!$slug){
            $categories = Category::latest();
        }else{
            $parentCategory = ParentCategory::where('slug',$slug)->first();
            $categories = Category::where('parent_category_id',$parentCategory->id);
        }
        // check search is exist or not
        if(request('search')){
            $search = request('search');
            $categories=$categories->where('name',"LIKE","%".$search."%");
        };
        $categories = Product::getRandomProductByCategories($categories->get());
        return view('user.categories',[
            "categories"=>$categories,
            "category_slug"=>ParentCategory::where('slug',$slug)->first()
        ]);
   }
}
