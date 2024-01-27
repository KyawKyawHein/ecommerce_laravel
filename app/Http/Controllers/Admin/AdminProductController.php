<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ParentCategory;
use Illuminate\Support\Str;
use App\Http\Requests\StoreAdminProductRequest;
use Illuminate\Support\Facades\File;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products= Product::latest('id')->paginate(5);
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = ParentCategory::latest('id')->get();
        return view('admin.product.create',compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminProductRequest $request)
    {
        // save file
        $file = $request->file('image');
        $file_name = uniqid().'.'.$file->getClientOriginalName();
        $file->move(public_path('assets/image/products'),$file_name);

        $product = Product::create([
            "name"=>$request->name,
            "slug"=>Str::slug($request->name),
            "description"=>$request->description,
            "image"=>$file_name,
            'price'=>$request->price,
            'stock_quantity'=>$request->stock_quantity,
            'category_id'=>$request->category_id,
            'view_count' =>0
        ]);
        return redirect()->route('admin.products.index')->with('success',"$product->name is created.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $parentCategories = ParentCategory::latest('id')->get();
        $categories= Category::latest('id')->get();
        $product= Product::where('slug',$slug)->first();
        return view('admin.product.edit',compact('product','categories','parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $product = Product::where('slug',$slug)->first();
        // check request has image or not
        if(!$request->file('image')){
            $file_name = $product->image;
        }else{
            // delete old image
            File::delete(public_path("assets/image/products/$product->image"));
            // store new image
            $file = $request->file('image');
            $file_name = uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('assets/image/products'),$file_name);
        }

        $product->update([
            "name"=>$request->name,
            "slug"=>Str::slug($request->name),
            "description"=>$request->description,
            "image"=>$file_name,
            'price'=>$request->price,
            'stock_quantity'=>$request->stock_quantity,
            'category_id'=>$request->category_id,
            'view_count' =>$product->view_count
        ]);
        return redirect()->route('admin.products.index')->with('success',"Successfully Updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $product = Product::where('slug',$slug)->first();
        if($product->image){
            File::delete(public_path("assets/image/products/$category->image"));
        }
        $product->delete();
        return redirect()->back()->with('success',"Delete Successfully.");
    }
}
