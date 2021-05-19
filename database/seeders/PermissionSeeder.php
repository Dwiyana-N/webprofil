<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    public function run()
    {
      // Reset cached roles and permissions
      app()[PermissionRegistrar::class]->forgetCachedPermissions();

      // create permissions
      $settings = Permission::create(['name' => 'manipulate-master-settings']);
      $data = Permission::create(['name' => 'manipulate-master-datas']);
      $roles = Permission::create(['name' => 'manipulate-master-roles']);
      $users = Permission::create(['name' => 'manipulate-master-users']);
      $content = Permission::create(['name' => 'manipulate-content']);

      // create roles and assign existing permissions
      $role1 = Role::create(['name' => 'operator', 'guard_name'  => 'web']);
      $role1->givePermissionTo([$data, $content]);

      $role2 = Role::create(['name' => 'admin', 'guard_name'  => 'web']);
      $role2->givePermissionTo([$settings, $data, $users]);

      $role3 = Role::create(['name' => 'super-admin', 'guard_name'  => 'web']);
      $role3->givePermissionTo([$settings, $data, $users, $roles, $content]);

      // create admin users
      $suadmin = User::create([
          'name'      => 'Super Admin Website',
          'username'  => 'suadmin',
          'email'     => 'suadmin@gmail.com',
          'password'  => bcrypt('password')
      ]);
      $suadmin->assignRole($role3);
      $admin = User::create([
          'name'      => 'Admin Website',
          'username'  => 'admin',
          'email'     => 'admin@gmail.com',
          'password'  => bcrypt('password')
      ]);
      $admin->assignRole($role2);
      $operator = User::create([
          'name'      => 'Operator Admin Website',
          'username'  => 'operator',
          'email'     => 'operator@gmail.com',
          'password'  => bcrypt('password')
      ]);
      $operator->assignRole($role1);
      
    }
}
