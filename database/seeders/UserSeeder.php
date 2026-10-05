<?php

namespace Database\Seeders;

use App\Models\UserManagement\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            'user' => 'Pengguna',
            'admin' => 'Administrator',
            'master' => 'Master Developer',
        ];

        foreach ($users as $role => $name) {
            $user = User::firstOrCreate(
                ['email' => $role . '@gmail.com'],
                [
                    'name' => $name,
                    'password' => bcrypt('password'),
                    'email_verified_at' => now(),
                    'remember_token' => Str::random(10),
                ]
            );
            if (!$user->hasRole($role)) {
                $user->assignRole($role);
            }
        }

        // Generate 50 sample users with role 'user'
        User::factory()->count(150)->create()->each(function ($user) {
            $user->assignRole('user');
        });
    }
}
