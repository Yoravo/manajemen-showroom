<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //role admin
        User::create([
            'name' => 'Radja Ravine Salfriandry',
            'usertype' => 'admin',
            'email' => 'ravine@admin.com',
            'password' => Hash::make('password123'),
        ]);

        //role user
        User::create([
            'name' => 'Radja Ravine Salfriandry',
            'usertype' => 'user',
            'email' => 'ravine@user.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
