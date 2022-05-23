<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('consola')->insert([
            'category_name' => Str::random(10)
        ]);
        DB::table('consola')->insert([
            'category_name' => Str::random(10)
        ]);
        DB::table('consola')->insert([
            'category_name' => Str::random(10)
        ]);
        DB::table('consola')->insert([
            'category_name' => Str::random(10)
        ]);
        DB::table('consola')->insert([
            'category_name' => Str::random(10)
        ]);

    }
}
