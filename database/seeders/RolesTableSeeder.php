<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'id' => 1,
            'name' => 'User',
        ]);

        Role::create([
            'id' => 2,
            'name' => 'Admin',
        ]);
        
        Role::create([
            'id' => 3,
            'name' => 'Office of the Principal',
        ]);
        
        Role::create([
            'id' => 4,
            'name' => 'Accounting Office',
        ]);
        
        Role::create([
            'id' => 5,
            'name' => 'Supply Office',
        ]);
        
        Role::create([
            'id' => 6,
            'name' => 'Library',
        ]);
        
        Role::create([
            'id' => 7,
            'name' => 'Bid and Awards Committee',
        ]);
        
        Role::create([
            'id' => 8,
            'name' => 'Physical Facilities',
        ]);
        
        Role::create([
            'id' => 9,
            'name' => 'Guidance Office',
        ]);
        
        Role::create([
            'id' => 10,
            'name' => 'Registrar',
        ]);
        
        Role::create([
            'id' => 11,
            'name' => 'Senior High Coordinator',
        ]);
        
        Role::create([
            'id' => 12,
            'name' => 'Subject Area Coordinator 1',
        ]);
        
        Role::create([
            'id' => 13,
            'name' => 'Subject Area Coordinator 2',
        ]);
        
        Role::create([
            'id' => 14,
            'name' => 'Subject Area Coordinator 3',
        ]);
        
        Role::create([
            'id' => 15,
            'name' => 'Subject Area Coordinator 4',
        ]);
        
        Role::create([
            'id' => 16,
            'name' => 'Subject Area Coordinator 5',
        ]);
        
        Role::create([
            'id' => 17,
            'name' => 'Subject Area Coordinator 6',
        ]);
        
        Role::create([
            'id' => 18,
            'name' => 'Subject Area Coordinator 7',
        ]);
        
        Role::create([
            'id' => 19,
            'name' => 'Subject Area Coordinator 8',
        ]);
    }
}
