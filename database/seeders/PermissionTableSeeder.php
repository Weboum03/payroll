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
            ['name' => 'On-Board', 'slug' => 'user-create', 'guard_name' => 'api'],
            ['name' => 'De-Board', 'slug' => 'user-delete' , 'guard_name' => 'api'],
            ['name' => 'Update Profile', 'slug' => 'user-edit' , 'guard_name' => 'api'],
            ['name' => 'View Profile', 'slug' => 'user-view' , 'guard_name' => 'api'],
            ['name' => 'Leave Approval', 'slug' => 'leave-edit' , 'guard_name' => 'api'],
            ['name' => 'View Leave History', 'slug' => 'leave-list' , 'guard_name' => 'api'],
            ['name' => 'Generate Payroll', 'slug' => 'payroll-create' , 'guard_name' => 'api'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
