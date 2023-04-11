<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\TaskResource;
use App\Models\Comment;
use App\Models\Task;
use App\Repositories\Task\TaskRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class TaskController extends Controller
{
    private TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository) 
    {
        $this->taskRepository = $taskRepository;
    }

    public function index()
    {
        $tasks = $this->taskRepository->index();
        return response()->json([
            TaskResource::collection($tasks), 
            'Get list type Successfully.'
        ]);
    }

    public function store(StoreTaskRequest $request)
    {
        $task = $this->taskRepository->store($request);
        
        return response()->json(['Task created successfully.', new TaskResource($task)]);
    }

    public function show($id){
        $task = $this->taskRepository->show($id);
        $comment = Comment::findOrFail($task->id)->get();
        return response()->json([
            'task' => new TaskResource($task), 
            'comment' => CommentResource::collection($comment),
            'Get list task Successfully.'
        ]);
    }

    public function update(StoreTaskRequest $request, $id) {
        $task = $this->taskRepository->update($request, $id);
 
        return response()->json(['Task updated successfully.', new TaskResource($task)]);
    }

    public function destroy($id){
        $this->taskRepository->destroy($id);
        return response()->json('Task deleted successfully');
    }

}
