<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat user super admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@local.test',
            'password' => bcrypt('password')
        ])->assignRole('administrator');
    }
}
