<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Task;
use App\Models\Type;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $tasks = Task::paginate(5);
        return view('tasks.index', compact('tasks', 'user'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Task $task)
    {
        $types = Type::get();
        $users = User::get();
        if (Gate::allows('isAdmin', $users)) {
            return view('tasks.create', compact('types','users', 'task'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        if ($request->has('file')) {
            $file = $request->file;
            $name = Str::random(10);
            $url = Storage::putFileAs('files', $file, $name . '.' . $file->extension());
            Task::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'file' => $url,
                'user_id' => $request->input('user_id'),
                'type_id' => $request->input('type_id'),
            ]);
        }
        else {
            Task::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'user_id' => $request->input('user_id'),
                'type_id' => $request->input('type_id'),
            ]);
        }

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $comment = Comment::where('task_id', $task->id)->get();
            return view('tasks.show', compact('task', 'comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task, User $users)
    {
        $types = Type::get();
        $users = User::get();
        if(Gate::allows('isAdmin', $users)){
            return view('tasks.edit', compact('task', 'users', 'types'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {   
        $task->update($request->input());
        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully');
    }

    public function downloadFile($id)
    {
        $task = Task::where('id', $id)->firstOrFail();
        $pathToFile = storage_path('app\\' . $task->file);
        return response()->download($pathToFile);
    }
}
