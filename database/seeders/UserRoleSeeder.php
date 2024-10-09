<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::create(['role_name' => 'Admin']);
        UserRole::create(['role_name' => 'Staff']);
        UserRole::create(['role_name' => 'Guest']);

    }
}
