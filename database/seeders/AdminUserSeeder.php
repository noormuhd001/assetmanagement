<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = new User();
        $user->name = 'SuperAdmin ';
        $user->email = 'adminofficial@gmail.com';
        $user->password = Hash::make('admin12345'); // Replace 'password' with your desired password
        $user->role = 1; // 1 for admin role
        $user->isActive = 1;
        $user->save();
    
    }
}
