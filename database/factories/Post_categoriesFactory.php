<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\Categories;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post_categories>
 */
class Post_categoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $Post=Post::inRandomOrder()->first();
        $Categories=Categories::inRandomOrder()->first();
        return [
            'categories_id' => $Categories->id,
            'post_id' => $Post->id        
        ];
    }
}
