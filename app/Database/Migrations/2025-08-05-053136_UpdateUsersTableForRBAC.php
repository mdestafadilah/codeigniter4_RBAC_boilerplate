<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateUsersTableForRBAC extends Migration
{
    public function up()
    {
        // Add role_id column to users table
        $fields = [
            'role_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'after' => 'role'
            ],
            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
                'after' => 'role_id'
            ],
            'last_login' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'is_active'
            ]
        ];
        
        $this->forge->addColumn('users', $fields);
        
        // Add foreign key constraint
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'SET NULL', 'CASCADE', 'users');
    }

    public function down()
    {
        // Drop foreign key first
        $this->forge->dropForeignKey('users', 'users_role_id_foreign');
        
        // Drop columns
        $this->forge->dropColumn('users', ['role_id', 'is_active', 'last_login']);
    }
}
