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
        $data = [
            'name' => 'Admin',
            'password' => Hash::make('admin12345'),
        ];

        if (Schema::hasColumn('users', 'role')) {
            $data['role'] = 'admin';
        }

        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            $data
        );
    }
}