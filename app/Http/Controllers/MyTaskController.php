<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Comment;

class MyTaskController extends Controller
{
    public function index() {
        $user = auth()->user();
        $tasks = Task::paginate(5);
        return view('tasks.mytask', compact('tasks', 'user'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show($id)
    {
        $tasks = Task::where('id', $id)->get();
        $user = User::get();
        foreach($tasks as $task){
            $comment = Comment::where('commentable_id', $task->id)->get();
        }
        // dd($comment);
            return view('tasks.mytask_show', compact('task', 'comment'));
    }

    public function update(Request $request, $id)
    {

        $task = Task::where('id', $id)->firstOrFail();
        $task->update($request->all());

        return redirect()->route('mytask.index')
            ->with('success', 'Task updated successfully');
    }
}
