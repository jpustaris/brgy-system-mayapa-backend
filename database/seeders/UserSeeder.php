<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 
     * 
     */

    protected static ?string $password;


    public function run()
    {
        User::create([
            'first_name' => 'Admin',
            'middle_name' => 'A',
            'last_name' => 'User',
            'email' => 'admin.brgy-mayapa@gmail.com',
            'role_id' => 1,
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'first_name' => 'User1',
            'middle_name' => 'A',
            'last_name' => 'User',
            'email' => 'user1.brgy-mayapa@gmail.com',
            'role_id' => 3,
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'first_name' => 'User2',
            'middle_name' => 'A',
            'last_name' => 'User',
            'email' => 'user2.brgy-mayapa@gmail.com',
            'role_id' => 2,
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
    }
}
