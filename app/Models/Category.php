<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ParentCategory;

class Category extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function parent_category(){
        return $this->belongsTo(ParentCategory::class);
    }
}
