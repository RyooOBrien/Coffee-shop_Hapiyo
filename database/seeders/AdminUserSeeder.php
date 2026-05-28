<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminData = [
            'name' => 'Admin',
            'password' => Hash::make('admin12345'),
        ];

        if (Schema::hasColumn('users', 'role')) {
            $adminData['role'] = 'admin';
        }

        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            $adminData
        );

        $kasirData = [
            'name' => 'Kasir',
            'password' => Hash::make('kasir12345'),
        ];

        if (Schema::hasColumn('users', 'role')) {
            $kasirData['role'] = 'kasir';
        }

        User::updateOrCreate(
            ['email' => 'kasir@gmail.com'],
            $kasirData
        );
    }
}