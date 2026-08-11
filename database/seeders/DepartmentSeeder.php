<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'IT', 'description' => 'Information Technology Department'],
            ['name' => 'HR', 'description' => 'Human Resources Department'],
            ['name' => 'Sales', 'description' => 'Sales and Marketing Department'],
            ['name' => 'Finance', 'description' => 'Finance and Accounting Department'],
            ['name' => 'Operations', 'description' => 'Operations and Logistics'],
        ];

        foreach ($departments as $dept) {
            \App\Models\Department::create($dept);
        }
    }
}
