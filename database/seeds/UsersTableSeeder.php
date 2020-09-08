<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $view_own_permission = Permission::create(['name' => 'view own profile']);

        $view_all_permission = Permission::create(['name' => 'view all profiles']);
       
        $edit_col_permission = Permission::create(['name' => 'edit collaborators']);

        $upgrade_col_permission = Permission::create(['name' => 'upgrade collaborators']);
        
        $edit_rh_permission = Permission::create(['name' => 'edit RH']);

        $superad = Role::create(['name' => 'superadmin']);
        $superad->givePermissionTo([$view_own_permission, $view_all_permission, $edit_col_permission, $edit_rh_permission, $upgrade_col_permission]);
       
        $rh = Role::create(['name' => 'rh']);
        $rh->givePermissionTo([$view_own_permission, $view_all_permission, $edit_col_permission, $upgrade_col_permission]); 
        
        $pm = Role::create(['name' => 'projectmanager']);
        $pm->givePermissionTo([$view_own_permission, $view_all_permission]);

        $emp = Role::create(['name' => 'collaborator']);
        $emp->givePermissionTo([$view_own_permission]);


        User::create([
            'name' => 'super admin',
            'email' => 'superad@test.com',
            'password' => Hash::make('superad'),
            'login' => 'superad'
        ])->syncRoles('superadmin');

        User::create([
            'name' => 'RH one',
            'email' => 'RH1@test.com',
            'password' => Hash::make('RH1'),
            'login' => 'RH1'
        ])->syncRoles('rh');

        User::create([
            'name' => 'RH two',
            'email' => 'RH2@test.com',
            'password' => Hash::make('RH2'),
            'login' => 'RH2'
        ])->syncRoles('rh');

        User::create([
            'name' => 'project manager',
            'email' => 'PM@test.com',
            'password' => Hash::make('PM'),
            'login' => 'PM'
        ])->syncRoles('projectmanager');

        User::create([
            'name' => 'Employee one',
            'email' => 'employee1@test.com',
            'password' => Hash::make('emp1'),
            'login' => 'emp1'
        ])->syncRoles('collaborator');

        User::create([
            'name' => 'Employee two',
            'email' => 'employee2@test.com',
            'password' => Hash::make('emp2'),
            'login' => 'emp2'
        ])->syncRoles('collaborator');

        User::create([
            'name' => 'Employee three',
            'email' => 'employee3@test.com',
            'password' => Hash::make('emp3'),
            'login' => 'emp3'
        ])->syncRoles('collaborator');
    }
}
