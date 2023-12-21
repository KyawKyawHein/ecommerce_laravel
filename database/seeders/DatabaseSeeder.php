<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\ParentCategory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user= User::factory()->create([
            "name" => "Kyaw Kyaw",
            "email" => "kkh@gmail.com",
            "password" => bcrypt('kyawkyawhein')
        ]);

        $admin = User::factory()->create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "isAdmin"=>1,
            "password" => bcrypt('kyawkyawhein')
        ]);
        $parentCategories = ['Health & Beauty',"Electronic Devices","TV & Home Appliances","Women's Fashion","Men's Fashion"];
        foreach($parentCategories as $category){
            ParentCategory::factory()->create([
                "name"=>$category,
                "slug"=>Str::slug(Str::lower($category))
            ]);
        }
        
        $beauties = ['Bath & Body',"Beauty Tools","Fragrances"];
        foreach($beauties as $beauty){
            Category::factory()->create([
                'parent_category_id'=> 1,
                'name'=>$beauty,
                'slug'=>Str::slug(Str::lower($beauty))
            ]);
        }
        
        $electronics = ['Mobiles',"Laptops","Tablets"];
        foreach($electronics as $electronic){
            Category::factory()->create([
                'parent_category_id'=> 2,
                'name'=>$electronic,
                'slug'=>Str::slug(Str::lower($electronic))
            ]);
        }

        $homeAccessories = ['TV & Videos Devices',"Home Audio","TV Accessories"];
        foreach($homeAccessories as $homeAccessory){
            Category::factory()->create([
                'parent_category_id'=> 3,
                'name'=>$homeAccessory,
                'slug'=>Str::slug(Str::lower($homeAccessory))
            ]);
        }

        $women = ['Clothing',"Women's Bags","Shoes"];
        foreach($women as $w){
            Category::factory()->create([
                'parent_category_id'=> 4,
                'name'=>$w,
                'slug'=>Str::slug(Str::lower($w))
            ]);
        }

        $men = ['Clothing',"Men's Bags","Shoes"];
        foreach($men as $m){
            Category::factory()->create([
                'parent_category_id'=> 5,
                'name'=>$m,
                'slug'=>Str::slug(Str::lower($m))
            ]);
        }
        $this->call([
            ProductSeeder::class,
            OrderSeeder::class
        ]);
    }
}
