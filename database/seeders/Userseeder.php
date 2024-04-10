<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' =>  'admin123',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' =>  'user123',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $admin->assignRole('Admin');
        $user->assignRole('User');
    }
}
