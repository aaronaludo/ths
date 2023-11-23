<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            'id' => 1,
            'name' => 'Pending',
        ]);

        Status::create([
            'id' => 2,
            'name' => 'Successful',
        ]);

        Status::create([
            'id' => 3,
            'name' => 'Failed',
        ]);
    }
}
