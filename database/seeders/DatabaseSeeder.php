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
        // Permission::create(['name' => 'view.home', "guard_name" => "web",]);
        // $admin = Role::create(['name' => 'admin', "guard_name" => "web",]);
        $user = Role::create(['name' => 'user', "guard_name" => "web",]);
        $admin = Role::where(['id' => 1])->first();
        $admin->givePermissionTo([
            'view.home'
        ]);
        $user->givePermissionTo([
            'view.home',
        ]);
    }
}
