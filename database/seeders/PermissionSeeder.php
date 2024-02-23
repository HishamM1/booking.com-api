<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::all()->keyBy('id');

        $permissions = [
            'properties-manage' => [Role::ROLE_PROPERTY_OWNER],
            'bookings-manage' => [Role::ROLE_USER],
        ];

        foreach ($permissions as $key => $roleIds) {
            $permission = Permission::create(['name' => $key]);
            foreach ($roleIds as $roleId) {
                if (isset($roles[$roleId])) {
                    $roles[$roleId]->permissions()->attach($permission->id);
                }
            }
        }
    }
}
