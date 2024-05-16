<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'On-Board', 'slug' => 'user-create'],
            ['name' => 'De-Board', 'slug' => 'user-delete'],
            ['name' => 'Update Profile', 'slug' => 'user-edit'],
            ['name' => 'View Profile', 'slug' => 'user-view'],
            ['name' => 'Leave Approval', 'slug' => 'leave-edit'],
            ['name' => 'View Leave History', 'slug' => 'leave-list'],
            ['name' => 'Generate Payroll', 'slug' => 'payroll-create'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
