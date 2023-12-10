<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(['name' => 'admin'], [
            'first_name' => 'Админ',
            'middle_name' => 'Админович',
            'last_name' => 'Админов',
            'password' => Hash::make('admin'),
        ]);
        $admin->assignRole('super-user');
    }
}
