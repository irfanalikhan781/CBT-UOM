<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
        ]);

        User::create([
            'name' => 'Sub Admin',
            'username' => 'subadmin',
            'email' => 'subadmin@example.com',
            'password' => Hash::make('password'),
            'role' => 'sub_admin',
            'department' => 'IT',
        ]);

        User::create([
            'name' => 'Candidate',
            'username' => 'candidate',
            'email' => 'candidate@example.com',
            'password' => Hash::make('password'),
            'role' => 'candidate',
            'department' => 'CS',
        ]);
    }
}
