<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\TaskResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Repositories\MyTask\MyTaskRepositoryInterFace;

class MyTaskController extends Controller
{
    private MyTaskRepositoryInterFace $myTaskRepository;

    public function __construct(MyTaskRepositoryInterface $myTaskRepository) 
    {
        $this->myTaskRepository = $myTaskRepository;
    }

    public function index() {
        $id = auth()->user()->id;
        $tasks = $this->myTaskRepository->index($id);
        return response()->json([
            TaskResource::collection($tasks), 
            'Get list task Successfully.'
        ]);
    }

    public function show($id) {
        $task = $this->myTaskRepository->show($id);
        $comment = Comment::findOrFail($task->id)->get();
        return response()->json([
            'task' => new TaskResource($task), 
            'comment' => CommentResource::collection($comment),
            'Get list task Successfully.'
        ]);
    }

    public function update(Request $request, $id){
        $task = $this->myTaskRepository->update($request, $id);
        return response()->json(['Task updated successfully.', new TaskResource($task)]);
    }
}
