<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class AdminAuthController extends Controller
{
    public function index(){
        return view('admin.index');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('home')->with('success',"Logout successfully.");
    }
}
