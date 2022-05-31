<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        //reparar usersssssssssssssssssssssssss
        \App\Models\User::factory(10)->create();
         \App\Models\Categories::factory(10)->create();
         \App\Models\Post::factory(10)->create();
         \App\Models\Post_categories::factory(10)->create();
         \App\Models\Comments::factory(10)->create();
         \App\Models\Reply::factory(10)->create();

    }
}
