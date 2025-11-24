<?php
namespace App\Http\Controllers;
use App\Events\TaskCreated; 
class TaskController extends Controller
{
    // ... інші методи

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

        $task = \App\Models\Task::create(array_merge($validated, [
            'project_id' => $id,
            'author_id' => \Illuminate\Support\Facades\Auth::id()
        ]));

        TaskCreated::dispatch($task);

        return response()->json($task, 201);
    }

    // ... інші методи
}
