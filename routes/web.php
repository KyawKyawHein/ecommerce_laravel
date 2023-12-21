<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminOrderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// User page
Route::get('/',[PageController::class,'index'])->name('home');
Route::get('/products/{product:slug',[PageController::class,'detail'])->name('product.show');

// Admin dashboard 
Route::middleware('isAdmin')->prefix('/admin')->name('admin.')->group(function(){
    Route::get('/',[AdminAuthController::class,'index'])->name('dashboard');
    //Category
    Route::get('/categories',[AdminCategoryController::class,'index'])->name('category');
    Route::get('/category/create',[AdminCategoryController::class,'create'])->name('category.create');
    Route::post('/category/create',[AdminCategoryController::class,'store'])->name('category.store');
    Route::get('/categories/{category:slug}/edit',[AdminCategoryController::class,'edit'])->name('category.edit');
    Route::put('/categories/{category:slug}/edit',[AdminCategoryController::class,'update'])->name('category.update');
    Route::delete('/categories/{category:slug}/delete',[AdminCategoryController::class,'destroy'])->name('category.destroy');
    Route::post('/get-child-categories',[AdminCategoryController::class,'getChildCategories']);

    //Product
    Route::resource('/products',AdminProductController::class);

    // Order
    Route::get('/orders',[AdminOrderController::class,'index'])->name('orders.index');
    Route::get('/orders/{order}/makeComplete',[AdminOrderController::class,'makeComplete'])->name('orders.makeComplete');
    Route::get('/orders/pending',[AdminOrderController::class,'showPending'])->name('orders.pending');
    Route::get('/orders/complete',[AdminOrderController::class,'showComplete'])->name('orders.complete');
});


// User Auth
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'postLogin'])->name('postLogin');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register',[AuthController::class,'postRegister'])->name('postRegister');
Route::delete('/logout',[AuthController::class,'logout'])->name('logout');



