<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'name'      => 'Admin Account',
            'username'  => 'adminuser',
            'email'     => 'admin@domain.com',
            'password'  => bcrypt('password')
        ]);
    }
}
