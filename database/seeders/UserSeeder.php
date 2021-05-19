<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suadmin = User::create([
            'name'      => 'Super Admin Website',
            'username'  => 'admin',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('password')
        ]);
        $suadmin->assignRole('admin');

        $operator = User::create([
            'name'      => 'Operator Admin Website',
            'username'  => 'operator',
            'email'     => 'operator@gmail.com',
            'password'  => bcrypt('password')
        ]);
        $operator->assignRole('operator');
                
    }
}
