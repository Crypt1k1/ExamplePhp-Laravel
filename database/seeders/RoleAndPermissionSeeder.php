<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Cars Permission
        Permission::create(['name' => 'index car']);
        Permission::create(['name' => 'show car']);
        Permission::create(['name' => 'create car']);
        Permission::create(['name' => 'edit car']);
        Permission::create(['name' => 'delete car']);
        //Reviews Permission
        Permission::create(['name' => 'index review']);
        Permission::create(['name' => 'show review']);
        Permission::create(['name' => 'create review']);
        Permission::create(['name' => 'edit review']);
        Permission::create(['name' => 'delete review']);


        $reader = Role::create(['name' => 'reader'])->givePermissionTo('create review', 'delete review');
        $moderator =  Role::create(['name' => 'moderator'])->givePermissionTo('create review',
            'delete review','index review', 'edit review' );
        $admin  =  Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());
    }

}
