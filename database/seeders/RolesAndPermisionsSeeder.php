<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermisionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission_create_task = Permission::firstOrCreate(['name' => 'create tasks']);
        $permission_edit_task = Permission::firstOrCreate(['name' => 'edit tasks']);
        $permission_delete_task = Permission::firstOrCreate(['name' => 'delete tasks']);
        $permission_view_task = Permission::firstOrCreate(['name' => 'view tasks']);
        $permission_assign_task = Permission::firstOrCreate(['name' => 'assign tasks']);
        $permission_manage_project = Permission::firstOrCreate(['name' => 'manage project']);
        $permission_track_time = Permission::firstOrCreate(['name' => 'track time']);
        $permission_view_reports = Permission::firstOrCreate(['name' => 'view reports']);

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $employee = Role::firstOrCreate(['name' => 'employee']);

        $admin->givePermissionTo([
            $permission_create_task,
            $permission_edit_task,
            $permission_delete_task,
            $permission_view_task,
            $permission_assign_task,
            $permission_manage_project,
            $permission_track_time,
            $permission_view_reports
        ]);

        $manager->givePermissionTo([
            $permission_create_task,
            $permission_edit_task,
            $permission_delete_task,
            $permission_view_task,
            $permission_assign_task,
            $permission_track_time,
            $permission_view_reports
        ]);

        $employee->givePermissionTo([
            $permission_view_task,
            $permission_track_time
        ]);

        $user = \App\Models\User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin',
            'password' => bcrypt('123455678'),
        ]);

        $user->assignRole('admin');
    }
}
