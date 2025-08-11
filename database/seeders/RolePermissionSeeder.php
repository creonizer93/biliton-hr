<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        $admin = Role::firstOrCreate(['name' => 'administrator']);
        $hr = Role::firstOrCreate(['name' => 'hr']);
        $clusterAdmin = Role::firstOrCreate(['name' => 'cluster_admin']);

        // Permissions (sesuaikan bila perlu)
        $perms = [
            'view all employees',
            'view cluster employees',
            'create employee',
            'edit employee',
            'delete employee',
        ];
        foreach ($perms as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }

        // Assign
        $admin->syncPermissions(Permission::all());
        $hr->syncPermissions(['view all employees', 'create employee', 'edit employee']);
        $clusterAdmin->syncPermissions(['view cluster employees', 'create employee', 'edit employee']);
    }
}
