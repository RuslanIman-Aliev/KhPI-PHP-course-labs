<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use App\Events\CommentCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task->comments);
    }

    public function store(Request $request, $id)
    {
        $request->validate(['body' => 'required|string']);

        $comment = Comment::create([
            'task_id' => $id,
            'author_id' => Auth::id(),
            'body' => $request->body
        ]);

        CommentCreated::dispatch($comment);

        return response()->json($comment, 201);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->author_id !== Auth::id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $comment->delete();
        return response()->json(['message' => 'Deleted']);
    }
}