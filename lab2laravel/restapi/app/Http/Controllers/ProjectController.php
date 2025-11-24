<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $projects = Project::where('owner_id', $userId)
            ->orWhereHas('users', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })->get();

        return response()->json($projects);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string']);

        $project = Project::create([
            'name' => $validated['name'],
            'owner_id' => Auth::id()
        ]);

        return response()->json($project, 201);
    }

    public function show($id)
    {
        return response()->json(Project::with('users')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        if ($project->owner_id !== Auth::id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $project->update($request->validate(['name' => 'string']));
        return response()->json($project);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        if ($project->owner_id !== Auth::id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $project->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
