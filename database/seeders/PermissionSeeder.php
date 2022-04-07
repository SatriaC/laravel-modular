<?php

namespace Database\Seeders;

use App\Models\Employees\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // create permissions
        Permission::create(['name' => 'role-inquiry']);
        Permission::create(['name' => 'role-create']);
        Permission::create(['name' => 'role-detail']);
        Permission::create(['name' => 'role-update']);
        Permission::create(['name' => 'role-permission']);

        Permission::create(['name' => 'organization-inquiry']);
        Permission::create(['name' => 'organization-create']);
        Permission::create(['name' => 'organization-detail']);
        Permission::create(['name' => 'organization-update']);
        Permission::create(['name' => 'organization-delete']);

        Permission::create(['name' => 'division-inquiry']);
        Permission::create(['name' => 'division-create']);
        Permission::create(['name' => 'division-detail']);
        Permission::create(['name' => 'division-update']);
        Permission::create(['name' => 'division-delete']);

        Permission::create(['name' => 'department-inquiry']);
        Permission::create(['name' => 'department-create']);
        Permission::create(['name' => 'department-detail']);
        Permission::create(['name' => 'department-update']);
        Permission::create(['name' => 'department-delete']);

        Permission::create(['name' => 'position-inquiry']);
        Permission::create(['name' => 'position-create']);
        Permission::create(['name' => 'position-detail']);
        Permission::create(['name' => 'position-update']);
        Permission::create(['name' => 'position-delete']);

        Permission::create(['name' => 'employee-inquiry']);
        Permission::create(['name' => 'employee-create']);
        Permission::create(['name' => 'employee-detail']);
        Permission::create(['name' => 'employee-update']);
        Permission::create(['name' => 'employee-delete']);
        Permission::create(['name' => 'employee-export']);
        Permission::create(['name' => 'employee-import']);

        Permission::create(['name' => 'attendance-inquiry']);
        Permission::create(['name' => 'attendance-detail']);
        Permission::create(['name' => 'attendance-check-in']);
        Permission::create(['name' => 'attendance-check-out']);
        Permission::create(['name' => 'attendance-approval']);
        Permission::create(['name' => 'attendance-statistic']);
        Permission::create(['name' => 'attendance-export']);

        // create roles and assign existing permissions

       $role1 = Role::create(['name' => 'super-admin']);
       $role1->givePermissionTo('role-inquiry');
       $role1->givePermissionTo('role-create');
       $role1->givePermissionTo('role-detail');
       $role1->givePermissionTo('role-update');
       $role1->givePermissionTo('role-permission');

       $role1->givePermissionTo('organization-inquiry');
       $role1->givePermissionTo('organization-create');
       $role1->givePermissionTo('organization-detail');
       $role1->givePermissionTo('organization-update');
       $role1->givePermissionTo('organization-delete');

       $role1->givePermissionTo('division-inquiry');
       $role1->givePermissionTo('division-create');
       $role1->givePermissionTo('division-detail');
       $role1->givePermissionTo('division-update');
       $role1->givePermissionTo('division-delete');

       $role1->givePermissionTo('department-inquiry');
       $role1->givePermissionTo('department-create');
       $role1->givePermissionTo('department-detail');
       $role1->givePermissionTo('department-update');
       $role1->givePermissionTo('department-delete');

       $role1->givePermissionTo('position-inquiry');
       $role1->givePermissionTo('position-create');
       $role1->givePermissionTo('position-detail');
       $role1->givePermissionTo('position-update');
       $role1->givePermissionTo('position-delete');

       $role1->givePermissionTo('employee-inquiry');
       $role1->givePermissionTo('employee-create');
       $role1->givePermissionTo('employee-detail');
       $role1->givePermissionTo('employee-update');
       $role1->givePermissionTo('employee-delete');
       $role1->givePermissionTo('employee-export');
       $role1->givePermissionTo('employee-import');

       $role1->givePermissionTo('attendance-inquiry');
       $role1->givePermissionTo('attendance-detail');
       $role1->givePermissionTo('attendance-check-in');
       $role1->givePermissionTo('attendance-check-out');
       $role1->givePermissionTo('attendance-approval');
       $role1->givePermissionTo('attendance-statistic');
       $role1->givePermissionTo('attendance-export');

       $role2 = Role::create(['name' => 'admin']);
       $role2->givePermissionTo('role-inquiry');
       $role2->givePermissionTo('role-create');
       $role2->givePermissionTo('role-detail');
       $role2->givePermissionTo('role-update');
       $role2->givePermissionTo('role-permission');

       $role2->givePermissionTo('organization-inquiry');
       $role2->givePermissionTo('organization-create');
       $role2->givePermissionTo('organization-detail');
       $role2->givePermissionTo('organization-update');
       $role2->givePermissionTo('organization-delete');

       $role2->givePermissionTo('division-inquiry');
       $role2->givePermissionTo('division-create');
       $role2->givePermissionTo('division-detail');
       $role2->givePermissionTo('division-update');
       $role2->givePermissionTo('division-delete');

       $role2->givePermissionTo('department-inquiry');
       $role2->givePermissionTo('department-create');
       $role2->givePermissionTo('department-detail');
       $role2->givePermissionTo('department-update');
       $role2->givePermissionTo('department-delete');

       $role2->givePermissionTo('position-inquiry');
       $role2->givePermissionTo('position-create');
       $role2->givePermissionTo('position-detail');
       $role2->givePermissionTo('position-update');
       $role2->givePermissionTo('position-delete');

       $role2->givePermissionTo('employee-inquiry');
       $role2->givePermissionTo('employee-create');
       $role2->givePermissionTo('employee-detail');
       $role2->givePermissionTo('employee-update');
       $role2->givePermissionTo('employee-delete');
       $role2->givePermissionTo('employee-export');
       $role2->givePermissionTo('employee-import');

       $role2->givePermissionTo('attendance-inquiry');
       $role2->givePermissionTo('attendance-detail');
       $role2->givePermissionTo('attendance-check-in');
       $role2->givePermissionTo('attendance-check-out');
       $role2->givePermissionTo('attendance-approval');
       $role2->givePermissionTo('attendance-statistic');
       $role2->givePermissionTo('attendance-export');


       // create demo users
       $user = User::create([
           'email' => 'superadmin@test.com',
           'employee_id' => 1,
           'password' => bcrypt('1234567890'),
       ]);
       $user->assignRole($role1);

       Employee::create([
           'nip' => 'superadmin',
           'email' => 'superadmin@test.com',
       ]);

       $user2 = User::create([
        'email' => 'admin@test.com',
        'employee_id' => 2,
        'password' => bcrypt('1234567890'),
        ]);
        $user2->assignRole($role2);

        Employee::create([
            'nip' => 'admin',
            'email' => 'admin@test.com',
        ]);
    }
}
