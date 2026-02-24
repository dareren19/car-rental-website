<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('superadmin'),
                'remember_token' => Str::random(10),
                'is_admin' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('superadmin'),
                'remember_token' => Str::random(10),
                'is_admin' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'daren',
                'email' => 'daren@yahoo.com',
                'email_verified_at' => now(),
                'password' => Hash::make('testuser'),
                'remember_token' => Str::random(10),
                'is_admin' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'marc',
                'email' => 'marc@yahoo.com',
                'email_verified_at' => now(),
                'password' => Hash::make('testuser'),
                'remember_token' => Str::random(10),
                'is_admin' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'david',
                'email' => 'david@yahoo.com',
                'email_verified_at' => now(),
                'password' => Hash::make('testuser'),
                'remember_token' => Str::random(10),
                'is_admin' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
