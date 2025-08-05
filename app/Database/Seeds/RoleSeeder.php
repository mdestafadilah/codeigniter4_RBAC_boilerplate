<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'name' => 'super_admin',
                'display_name' => 'Super Administrator',
                'description' => 'Full system access with all permissions',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Administrative access with most permissions',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'operator',
                'display_name' => 'Operator',
                'description' => 'Can manage mahasiswa data',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'user',
                'display_name' => 'User',
                'description' => 'Basic user with limited access',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('roles')->insertBatch($roles);

        // Assign permissions to roles
        $roleModel = new \App\Models\Role();
        $permissionModel = new \App\Models\Permission();
        
        $superAdminRole = $roleModel->where('name', 'super_admin')->first();
        $adminRole = $roleModel->where('name', 'admin')->first();
        $operatorRole = $roleModel->where('name', 'operator')->first();
        $userRole = $roleModel->where('name', 'user')->first();
        
        $allPermissions = $permissionModel->findAll();
        $allPermissionIds = array_column($allPermissions, 'id');
        
        // Super Admin gets all permissions
        if ($superAdminRole) {
            $roleModel->syncPermissions($superAdminRole['id'], $allPermissionIds);
        }
        
        // Admin gets most permissions (except some sensitive ones)
        if ($adminRole) {
            $adminPermissions = [];
            foreach ($allPermissions as $permission) {
                // Admin can do everything except manage super admin stuff
                $adminPermissions[] = $permission['id'];
            }
            $roleModel->syncPermissions($adminRole['id'], $adminPermissions);
        }
        
        // Operator gets mahasiswa and dashboard permissions
        if ($operatorRole) {
            $operatorPermissions = [];
            foreach ($allPermissions as $permission) {
                if (in_array($permission['module'], ['mahasiswa', 'dashboard', 'reports'])) {
                    $operatorPermissions[] = $permission['id'];
                }
            }
            $roleModel->syncPermissions($operatorRole['id'], $operatorPermissions);
        }
        
        // User gets basic permissions
        if ($userRole) {
            $userPermissions = [];
            foreach ($allPermissions as $permission) {
                if ($permission['name'] === 'dashboard.view' || 
                    $permission['name'] === 'mahasiswa.view' ||
                    $permission['name'] === 'reports.view') {
                    $userPermissions[] = $permission['id'];
                }
            }
            $roleModel->syncPermissions($userRole['id'], $userPermissions);
        }
    }
}
