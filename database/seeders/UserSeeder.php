<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'username' => 'admin',
            ],
            [
                'email' => 'admin@sekolah.sch.id',
                'password' => 'admin123',
                'role' => 'admin',
            ]
        );
    }
}