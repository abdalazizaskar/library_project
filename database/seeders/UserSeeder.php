<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'user@library.test'],
            [
                'name' => 'مستخدم تجريبي',
                'password' => 'password',
                'phone' => '0500000001',
                'email_verified_at' => now(),
            ],
        );

        User::factory()->count(10)->create();
    }
}
