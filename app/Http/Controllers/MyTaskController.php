<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class MyTaskController extends Controller
{
    public function index() {
        $user = auth()->user();
        $tasks = Task::paginate(5);
        return view('tasks.mytask', compact('tasks', 'user'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
