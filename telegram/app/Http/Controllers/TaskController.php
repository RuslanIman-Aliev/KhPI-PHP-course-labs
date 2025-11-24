<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Events\TaskCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // ... інші методи index, show, update, destroy залишаються без змін ...

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'assignee_id' => 'nullable|exists:users,id',
            'status' => 'in:new,in_progress,done',
            'priority' => 'integer',
            'due_date' => 'nullable|date'
        ]);

        $task = Task::create(array_merge($validated, [
            'project_id' => $id,
            'author_id' => Auth::id()
        ]));

        TaskCreated::dispatch($task);

        return response()->json($task, 201);
    }
}