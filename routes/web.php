<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminBannerController;
use App\Http\Controllers\Admin\AdminParentCategoryController;

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
    //Product
Route::get('/products/{product:slug}',[ProductController::class,'detail'])->name('product.show');
Route::get('/{parentCategory}/{category}/products',[ProductController::class,'productsByCategory'])->name('productsByCategory');
    //Category
Route::get('/categories',[CategoryController::class,'index'])->name('categories');
Route::get('/{parentCategory}/categories',[CategoryController::class,'index'])->name('parentCategory.categories');
    //Add to cart
Route::get('/addtocart',[CartController::class,'index'])->name('addToCart.index');
Route::post('/addtocart',[CartController::class,'addToCart'])->name('addToCart');
Route::post('/addtocart/increase-quantity',[CartController::class,'increaseQuantity'])->name('addToCart.increaseQuantity');
Route::post('/addtocart/decrease-quantity',[CartController::class,'decreaseQuantity'])->name('addToCart.decreaseQuantity');
 Route::post('/cart/removeProduct',[CartController::class,'removeProduct'])->name('cart.removeProduct');
    //Account Setting
Route::get('account-setting',[PageController::class, "accountDetail"])->name('accountDetail');
Route::get('change-info', [PageController::class, "changeInfo"])->name( 'changeInfo');
Route::post('change-info', [PageController::class, "postChangeInfo"])->name( 'postChangeInfo');
Route::get('change-password', [PageController::class, "changePassword"])->name( 'changePassword');
Route::post('change-password', [PageController::class, "postChangePassword"])->name('postChangePassword');
    //Order
Route::get('/orders',[OrderController::class,'index'])->name('orders.index');
Route::post('/addOrder',[OrderController::class,'addOrder'])->name('addOrder');

// User Auth
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'postLogin'])->name('postLogin');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register',[AuthController::class,'postRegister'])->name('postRegister');
Route::delete('/logout',[AuthController::class,'logout'])->name('logout');

// Admin dashboard
Route::middleware('isAdmin')->prefix('/admin')->name('admin.')->group(function(){
    Route::get('/',[AdminAuthController::class,'index'])->name('dashboard');

    // Parent Category
    Route::resource('/parent-categories',AdminParentCategoryController::class);

    //Category
    Route::get('/categories/all',[AdminCategoryController::class,'index'])->name('category');
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

    // Banner
    Route::resource('/banners',AdminBannerController::class);

    Route::delete('/logout',[AdminAuthController::class,'logout'])->name('logout');
});



