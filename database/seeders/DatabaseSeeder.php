<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Permission::insert([
        //     ['name' => 'create.user', 'guard_name' => 'web'],
        //     ['name' => 'view.user', 'guard_name' => 'web'],
        //     ['name' => 'edit.user', 'guard_name' => 'web'],
        //     ['name' => 'delete.user', 'guard_name' => 'web'],
        // ]);
        // $admin = Role::create(['name' => 'admin', "guard_name" => "web",]);
        // $user = Role::create(['name' => 'user', "guard_name" => "web",]);
        // $admin = Role::where(['id' => 1])->first();
        $user = Role::where(['id' => 2])->first();
        // $admin->givePermissionTo([
        //     'create.user',
        //     'edit.user',
        //     'delete.user',
        //     'view.user',
        // ]);
        $user->givePermissionTo([
            'view.home',
        ]);
    }
}
