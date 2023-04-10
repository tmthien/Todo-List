<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Comment;
use App\Models\Task;
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
        if ($request->has('file')) {
            $file = $request->file;
            $name = Str::random(10);
            $url = Storage::putFileAs('files', $file, $name . '.' . $file->extension());
            $task = Task::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'file' => $url,
                'user_id' => $request->input('user_id'),
                'type_id'=> $request->input('type_id'),
            ]);
        }
        else {
            $task = Task::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'user_id' => $request->input('user_id'),
                'type_id'=> $request->input('type_id'),
            ]);
        }

        return response()->json([
            'message' => 'Task successfully created',
            'task' => $task
        ]);
    }

    public function show($id){
        $task = Task::where('id', $id)->firstOrFail();
        $comment = Comment::where('task_id', $task->id)->get();
        return response()->json([
            'message' => 'Show detail task',
            'task' => $task,
            'comment' => $comment,
        ]);
    }

    public function update(StoreTaskRequest $request, $id) {
        $task = Task::find($id);
        if ($request->has('file')) {
            $file = $request->file;
            $name = Str::random(10);
            $url = Storage::putFileAs('files', $file, $name . '.' . $file->extension());
            $task->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'file' => $url,
                'user_id' => $request->input('user_id'),
                'type_id'=> $request->input('type_id'),
            ]);
        }
        else {
            $task->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'user_id' => $request->input('user_id'),
                'type_id'=> $request->input('type_id'),
            ]);
        }
        // $task = Task::find($id);
        // $task->update($request->all());
 
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
