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
        Permission::insert([
            ['name' => 'bill.create', 'guard_name' => 'web'],
            ['name' => 'bill.index', 'guard_name' => 'web'],
            ['name' => 'bill.delete', 'guard_name' => 'web'],
            ['name' => 'bill.edit', 'guard_name' => 'web'],
        ]);
        $admin = Role::create(['name' => 'superAdmin', "guard_name" => "web",]);
        // $user = Role::create(['name' => 'user', "guard_name" => "web",]);
        $admin = Role::where(['id' => 2])->first();
        $superadmin = Role::where(['id' => 3])->first();
        // $user = Role::where(['id' => 2])->first();
        $admin->givePermissionTo([
            'bill.index',
        ]);
        $superadmin->givePermissionTo([
            'bill.create',
            'bill.delete',
            'bill.index',
            'bill.edit',
            'create.user',
            'edit.user',
            'delete.user',
            'view.user',
            'view.home',
        ]);
        // $user->givePermissionTo([
        //     'view.home',
        // ]);
    }
}
