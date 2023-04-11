<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\TaskResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Task;

class MyTaskController extends Controller
{
    public function index() {
        $user_id = auth('api')->user()->id;
        $tasks = Task::where('user_id', $user_id)->get();
        return response()->json([
            TaskResource::collection($tasks), 
            'Get list task Successfully.'
        ]);
    }

    public function show($id) {
        $task = Task::find($id);
        $comment = Comment::where('task_id', $task->id)->first();
        return response()->json([
            'task' => new TaskResource($task), 
            'comment' => new CommentResource($comment),
            'Get list task Successfully.'
        ]);
    }

    public function update(Request $request, $id){
        $task  = Task::find($id);
        $task->update([
            'status'=> $request->status
        ]);
        return response()->json(['Task updated successfully.', new TaskResource($task)]);
    }
}
