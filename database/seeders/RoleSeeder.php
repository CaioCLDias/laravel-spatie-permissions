<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'Admin']);

        $useRole = Role::create(['name' => 'User']);

        $permissions = Permission::pluck('id', 'id')->all();

        $adminRole->syncPermissions($permissions);

        $useRole->givePermissionTo([
            'read-user',
            'read-role'
        ]);

    }
}
