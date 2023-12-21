<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->word();
        return [
            "name"=>$name,
            "slug"=>Str::slug($name).'-'.Str::random(5),
            "description"=>fake()->sentence(),
            "price"=>fake()->numberBetween(1000,30000),
            "stock_quantity"=>fake()->randomDigit(),
            "category_id"=>Category::all()->random()->id,
            "view_count"=>0
        ];
    }
}
