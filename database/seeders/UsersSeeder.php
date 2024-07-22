<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserRole;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = UserRole::all();

        foreach ($roles as $role)
        {
            User::query()->create([
                'user_role_id'  => $role->id,
                'name'          => $role->name.' Account',
                'email'         => $role->name.'@domain.com',
                'password'      => bcrypt($role->name.'password')
            ]);
        }
    }
}
