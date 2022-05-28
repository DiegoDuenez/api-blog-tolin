<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comments>
 */
class CommentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $usuario=User::inRandomOrder()->first();
        $Post=Post::inRandomOrder()->first();

        return [
            //
            'description' => Str::random(10),
            'user_id' => $usuario->id,
            'post_id' => $Post->id


        ];
    }
}
