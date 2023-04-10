<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Comment;
use App\Models\Type;

class MyTaskController extends Controller
{
    public function index() {
        $type = Type::get();
        $user = auth()->user();
        $tasks = Task::paginate(5);
        return view('tasks.mytask', compact('tasks', 'user', 'type'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show($id)
    {
        $type = Type::get();
        $tasks = Task::where('id', $id)->get();
        foreach($tasks as $task){
            $comment = Comment::where('task_id', $task->id)->get();
        }
            return view('tasks.mytask_show', compact('task', 'comment', 'type'));
    }

    public function update(Request $request, $id)
    {

        $task = Task::where('id', $id)->firstOrFail();
        $task->update($request->all());

        return redirect()->route('mytasks.index')
            ->with('success', 'Task updated successfully');
    }
}
