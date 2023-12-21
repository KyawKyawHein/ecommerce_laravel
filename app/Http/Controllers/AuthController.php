<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(){
        return view('user.register');
    }
    public function postRegister(Request $request){
        $formData = $request->validate([
            "name"=>['required'],
            "email"=>['required','email','unique:users,email'],
            "password"=>['required','confirmed']
        ]);
        $user  = User::create($formData);
        return redirect()->route('login')->with('success',"Register successfully.Please login with that account.");
    }

    public function login(){
        return view('user.login');
    }
    public function postLogin(Request $request){
        $formData = $request->validate([
            "email"=>['required','email','exists:users,email'],
            "password"=>['required']
        ]);
        if(!Auth::attempt($formData)){
            return redirect()->back()->with('error',"Login fail.");
        }else{
            return redirect()->route('home')->with('success',"Welcome");
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('home')->with('success',"Logout successfully.");
    }
}
