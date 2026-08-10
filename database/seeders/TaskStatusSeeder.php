<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaskStatus;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskStatus::create(['name' => 'new']);
        TaskStatus::create(['name' => 'in_progress']);
        TaskStatus::create(['name' => 'testing']);
        TaskStatus::create(['name' => 'completed']);
    }
}
