<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'title' => 'Task 1',
            'description' => 'Description for Task 1',
            //'status' => 'pending',
        ]);

        Task::create([
            'title' => 'Task 2',
            'description' => 'Description for Task 2',
            //'status' => 'pending',
        ]);

        Task::create([
            'title' => 'Task 3',
            'description' => 'Description for Task 3',
            //'status' => 'pending',
        ]);
    }
}
