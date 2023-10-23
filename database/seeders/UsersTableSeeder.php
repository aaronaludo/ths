<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role_id' => 1,
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('user123'),
        ]);

        User::create([
            'role_id' => 2,
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
        ]); 
        
        User::create([
            'role_id' => 3,
            'name' => 'Recipient',
            'email' => 'recipient@example.com',
            'password' => bcrypt('recipient123'),
        ]); 
        
        User::create([
            'role_id' => 4,
            'name' => 'Recipient Second',
            'email' => 'recipientsecond@example.com',
            'password' => bcrypt('recipient123'),
        ]); 

    }
}
