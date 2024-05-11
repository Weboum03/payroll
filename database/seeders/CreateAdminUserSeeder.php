<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Payroll',
            'first_name' => 'Payroll',
            'last_name' => 'user',
            'employee_id' => 73587458,
            'email' => 'admin@demo.com',
            'phone' => '1234567894',
            'password' => bcrypt('12345678')
        ]);

        $role = Role::create(['name' => 'admin', 'guard_name' => 'adminApi']);
        $role2 = Role::create(['name' => 'user', 'guard_name' => 'api']);
        $permissions = [
            'post-list',
            'post-create',
            'post-edit',
            'post-delete'
            ];
        $role2->syncPermissions($permissions);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
