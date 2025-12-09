<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function getAll()
    {
        return Task::latest()->get();
    }

    public function store(array $data)
    {
        return Task::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'priority' => $data['priority'],
        ]);
    }

    public function update(Task $task, array $data)
    {
        $task->update([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'priority' => $data['priority'],
        ]);

        return $task;
    }

    public function destroy(Task $task)
    {
        return $task->delete();
    }
}
