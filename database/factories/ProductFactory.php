<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(10, 100),
            'provider_id' => function() {
                return \App\Models\Provider::count() ? \App\Models\Provider::inRandomOrder()->first()->id : \App\Models\Provider::factory()->create()->id;
            }            
        ];
    }
}