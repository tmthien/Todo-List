<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return response()->json([
            'message' => 'Get task list Successfully',
            'task' => $tasks
        ]);
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return response()->json([
            'message' => 'Task successfully created',
            'task' => $task
        ]);
    }

    public function show($id){
        $task = Task::where('id', $id)->firstOrFail();
        return response()->json([
            'message' => 'Show detail task',
            'task' => $task,
        ]);
    }

    public function update(StoreTaskRequest $request, $id) {
        $task = Task::find($id);
        $task->update($request->all());
 
        return response()->json([
            "msg" => "Task updated successfully",
            "task" => $task,
        ]);
    }

    public function destroy($id){
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json([
            'massage' => 'Delete Task successfully',
        ]);
    }

}
