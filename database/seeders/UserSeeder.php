<?php

namespace Database\Seeders;

use App\Models\User;
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
        $users = ['user', 'admin', 'master'];

        foreach ($users as $value) {
            $user = User::firstOrCreate(
                ['email' => $value . '@gmail.com'],
                [
                    'name' => fake()->name(),
                    'password' => bcrypt('password'),
                    'email_verified_at' => now(),
                    'remember_token' => Str::random(10),
                ]
            );
            if (!$user->hasRole($value)) {
                $user->assignRole($value);
            }
        }

        // Generate 50 sample users with role 'user'
        User::factory()->count(50)->create()->each(function ($user) {
            $user->assignRole('user');
        });
    }
}
