<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'file' => 'file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        
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

    public function update(Request $request, $id) {
        $task = Task::find($id);
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
 
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
