<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Project;
use Symfony\Component\HttpFoundation\Response;

class CheckProjectAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $projectId = $request->route('id') ?? $request->route('project_id');

        if (!$projectId) {
            $task = \App\Models\Task::find($request->route('task_id'));
            if ($task) {
                $projectId = $task->project_id;
            }
        }

        $project = Project::find($projectId);

        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $isOwner = $project->owner_id === $request->user()->id;
        $isMember = $project->users()->where('user_id', $request->user()->id)->exists();

        if (!$isOwner && !$isMember) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}