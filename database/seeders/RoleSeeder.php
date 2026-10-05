<?php

namespace Database\Seeders;

use App\Models\UserManagement\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'master']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
        Role::create(['name' => 'ketua']);
        Role::create(['name' => 'sekretaris']);
        Role::create(['name' => 'bendahara']);
        Role::create(['name' => 'anggota']);
    }
}
