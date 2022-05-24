<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Comments;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reply>
 */
class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        
        $usuario=User::all()->inRandomOrder()->first();
        $Comments=Comments::all()->inRandomOrder()->first();

        return [
            //
            'description' => Str::random(10),
            'user_id' => $usuario->id,
            'comments_id' => $Comments->id


        ];
    }
}
