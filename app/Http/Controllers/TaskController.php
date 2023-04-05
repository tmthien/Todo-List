<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = auth()->user();
        $tasks = Task::paginate(5);
        return view('tasks.index', compact('tasks', 'user'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
        ]);
        
        if (!$request->has('file')) {
            return response()->json(['message' => 'Missing file'], 422);
        };
        // dd($request->file);
        $file = $request->file;
        $name = Str::random(10);
        $url = Storage::putFileAs('files', $file, $name.'.'.$file->extension());

        $task = Task::create([
            'title' => $request -> input('title'),
            'description' => $request -> input('description'),
            'file' => env('APP_URL') . '/' . $url,
        ]);

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
        $comment = Comment::where('commentable_id',$task->id)->get();
        // dd($comment);
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
        $users = User::get();
        return view('tasks.edit', compact('task','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        // dd($task);
        // dd($request);
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        
        $task->update($request->all());

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

    // public function downloadFile(Task $tasks) {
    //     $tasks = Task::get();
    //     dd($tasks);
    //     foreach($tasks as $task){
    //         $pathToFile = storage_path('app' . $task->file);
    //         return response()->download($pathToFile);
    //     }
    // }

    public function downloadFile($id){
        $task = Task::where('id', $id)->firstOrFail();
        $pathToFile = storage_path('app/' . $task->file);
        return response()->download($pathToFile);
    }
}
