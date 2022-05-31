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

        Permission::create(['name'=>'admin.Categories.index'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.Categories.create'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.Categories.edit'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.Categories.destroy'])->syncRoles([$role1]);

        Permission::create(['name'=>'admin.users.index'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.users.create'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.users.edit'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.users.destroy'])->syncRoles([$role1]);

        Permission::create(['name'=>'admin.Posts.index'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.Posts.create'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.Posts.edit'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.Posts.destroy'])->syncRoles([$role1]);

    }
}
