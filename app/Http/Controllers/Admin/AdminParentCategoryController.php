<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParentCategory;
use Illuminate\Support\Str;

class AdminParentCategoryController extends Controller
{
     public function index(){
        $parentCategories = ParentCategory::latest('id')->paginate(5);
        return view('admin.parentCategory.index',compact('parentCategories'));
    }

    public function create(){
        return view('admin.parentCategory.create');
    }

    public function store(Request $request){
        $request->validate([
            "name"=>['required','unique:parent_categories,name'],
        ]);
        $category=ParentCategory::create([
            'name'=>$request->name,
            "slug"=>Str::slug($request->name),
        ]);
        return redirect()->route('admin.parent-categories.index')->with('success',$category->name." is created.");
    }

    public function edit(ParentCategory $parentCategory){
        return view('admin.parentCategory.edit',compact('parentCategory'));
    }

    public function update(Request $request,ParentCategory $parentCategory){
        $request->validate([
            'name'=>['required',"unique:parent_categories,name,$parentCategory->id"],
        ]);
        $parentCategory->update([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
        ]);
        return redirect()->route('admin.parent-categories.index')->with('success',"Successfully Updated.");
    }

    public function destroy(ParentCategory $parentCategory){
        $parentCategory->delete();
        return redirect()->route('admin.parent-categories.index')->with('success','Successfully Deleted.');
    }
}
