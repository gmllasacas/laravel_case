<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'role_id' => 1,
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('base_app'),
        ]);
    }
}
