<?php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request, $id)
    {
        $query = Task::where('project_id', $id);

        if ($request->has('status')) $query->where('status', $request->status);
        if ($request->has('assignee_id')) $query->where('assignee_id', $request->assignee_id);

        return response()->json($query->get());
    }

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

        return response()->json($task, 201);
    }

    public function show($id)
    {
        $task = Task::with('comments')->findOrFail($id);

        $user = Auth::user();
        $project = $task->project;

        if ($project->owner_id !== $user->id && !$project->users->contains($user->id)) {
             return response()->json(['message' => 'Forbidden'], 403);
        }

        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        if ($task->author_id !== Auth::id() && $task->project->owner_id !== Auth::id()) {
             return response()->json(['message' => 'Forbidden'], 403);
        }

        $task->update($request->all());
        return response()->json($task);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        if ($task->author_id !== Auth::id() && $task->project->owner_id !== Auth::id()) {
             return response()->json(['message' => 'Forbidden'], 403);
        }

        $task->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
