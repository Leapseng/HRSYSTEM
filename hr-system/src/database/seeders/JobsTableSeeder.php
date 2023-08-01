<?php

namespace Database\Seeders;

use App\Models\Admin\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Job::create([
            'department_id' => 1,
            'title' => 'Web Developer',
        ]);

        Job::create([
            'department_id' => 1,
            'title' => 'Mobile App Developer',
        ]);

        Job::create([
            'department_id' => 2,
            'title' => 'Accountant',
        ]);

        Job::create([
            'department_id' => 2,
            'title' => 'Loan Officer',
        ]);
    }
}
