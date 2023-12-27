<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Cart;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    // public function carts(){
    //     return $this->belongsToMany(Cart::class, 'cart_product')->withPivot('quantity');
    // }

      //get random products by categories
    static function getRandomProductByCategories($categories){
        $arr = [];
        //get random product
        foreach($categories as $category){
            $randomPd = Product::where('category_id',$category->id)->inRandomOrder()->first();

            // put into arr
            $arr[]=[
                'category'=>$category,
                "randomPd"=>$randomPd
            ];
        }
        return $arr;
   }
}
