<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'cisco',
            'email'=>'cisco@gmail.com',
            'email_verified_at'=>'2022-04-21 04:46:24',
            'password'=>bcrypt('123456789'),

        ])->assignRole('Admin');

        User::create([
            'name'=>'diego',
            'email'=>'diego@gmail.com',
            'email_verified_at'=>'2022-04-21 04:46:24',
            'password'=>bcrypt('123456789'),

        ])->assignRole('Admin');

        User::create([
            'name'=>'andres',
            'email'=>'andres@gmail.com',
            'email_verified_at'=>'2022-04-21 04:46:24',
            'password'=>bcrypt('123456789'),

        ])->assignRole('Admin');

        User::Create([
            'name'=>'Brayan',
            'email'=>'brayan@gmail.com',
            'email_verified_at'=>'2022-04-21 04:46:24',
            'password'=>bcrypt('123456789')
        ])->assignRole('Admin');

        //User::factory(9)->create();
    }
}
