<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name'=>'Admin']);
        $role2 = Role::create(['name'=>'Normal']);

        Permission::create(['name'=>'Admin'])->assignRole([$role1]);
        Permission::create(['name'=>'Normal'])->assignRole([$role2]);

        Permission::create(['name'=>'admin.Categories.index'])->assignRole([$role1]);
        Permission::create(['name'=>'admin.Categories.create'])->assignRole([$role1]);
        Permission::create(['name'=>'admin.Categories.edit'])->assignRole([$role1]);
        Permission::create(['name'=>'admin.Categories.destroy'])->assignRole([$role1]);

        Permission::create(['name'=>'admin.users.index'])->assignRole([$role1]);
        Permission::create(['name'=>'admin.users.create'])->assignRole([$role1]);
        Permission::create(['name'=>'admin.users.edit'])->assignRole([$role1]);
        Permission::create(['name'=>'admin.users.destroy'])->assignRole([$role1]);

        Permission::create(['name'=>'admin.Posts.index'])->assignRole([$role1]);
        Permission::create(['name'=>'admin.Posts.create'])->assignRole([$role1]);
        Permission::create(['name'=>'admin.Posts.edit'])->assignRole([$role1]);
        Permission::create(['name'=>'admin.Posts.destroy'])->assignRole([$role1]);

    }
}
