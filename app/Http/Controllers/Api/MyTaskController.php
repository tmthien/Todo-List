<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class MyTaskController extends Controller
{
    public function index() {
        $user_id = auth('api')->user()->id;
        $task = Task::where('user_id', $user_id)->get();
        return response()->json([
            'massage'=>'Get list task Successfully',
            'Task' => $task
        ]);
    }

    public function show($id) {
        $task = Task::find($id);
        return response()->json([
            'massage'=>'Get detail task Successfully',
            'Task' => $task
        ]);
    }

    public function update(Request $request, $id){
        $task  = Task::find($id);
        $task->update([
            'status'=> $request->status
        ]);
        return response()->json([
            'massage' => 'Update status user Successfully',
            'task' => $task,
        ]);
    }
}
