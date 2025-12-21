<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Clear the users table first
        DB::table('users')->truncate();

        // Create Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('superadmin123'),
            'phone' => '081234567890',
            'role' => 'super_admin',
            'email_verified_at' => now(),
        ]);

        // Create Supplier
        User::create([
            'name' => 'Supplier',
            'email' => 'supplier@example.com',
            'password' => Hash::make('supplier123'),
            'phone' => '081234567891',
            'role' => 'supplier',
            'email_verified_at' => now(),
        ]);

        // Create Dropshipper
        User::create([
            'name' => 'Dropshipper',
            'email' => 'dropshipper@example.com',
            'password' => Hash::make('dropshipper123'),
            'phone' => '081234567892',
            'role' => 'dropshipper',
            'email_verified_at' => now(),
        ]);

        $this->command->info('Users created successfully!');
    }
}
