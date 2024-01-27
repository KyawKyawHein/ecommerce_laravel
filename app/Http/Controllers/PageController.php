<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ParentCategory;
use App\Models\Cart;
use App\Models\Banner;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    // account detail
    public function accountDetail(Request $request){
        $currentUser=$request->user();
        return view('user.account.account-detail',compact('currentUser'));
    }

    //  change info
    public function changeInfo(Request $request){
        $currentUser = $request->user();
        return view('user.account.change-info', compact('currentUser'));
    }
    public function postChangeInfo(Request $request){
        $formData=$request->validate([
            'name' => ['required'],
            "address" => ['required', 'string'],
            'password' => ['required']
        ]);
        $currentUser = $request->user();
        if(Hash::check($formData['password'],$currentUser->password)){
            $user = User::find($currentUser->id);
            $user->name = $formData['name'];
            $user->address = $formData['address'];
            $user->update();
            return redirect()->back()->with('success',"User info changed successfully.");
        }else{
            return redirect()->back()->withErrors([
                'password'=>"Password is incorrect."
            ]);
        }
    }

    // change password
    public function changePassword(Request $request)
    {
        $currentUser = $request->user();
        return view('user.account.change-password', compact('currentUser'));
    }
    public function postChangePassword(Request $request)
    {
        $formData = $request->validate([
            'password' => ['required','confirmed']
        ]);
        $user = User::find($request->user()->id);
        $user->update([
            "password"=>bcrypt($formData['password'])
        ]);
        Auth::logout();
        return redirect()->route('login')->with("success","Password changed successfully.Please login again.");
    }
}
