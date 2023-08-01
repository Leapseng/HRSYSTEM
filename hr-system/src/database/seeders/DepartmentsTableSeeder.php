<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'name' => 'IT',
        ]);

        Department::create([
            'name' => 'Financial',
        ]);
    }
}
