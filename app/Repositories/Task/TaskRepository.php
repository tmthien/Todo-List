<?php 

namespace App\Repositories\Task;

use App\Models\Task;
use App\Repositories\Task\TaskRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class TaskRepository implements TaskRepositoryInterface
{
    private Task $task;
    public function __construct(Task $task) 
    {
        $this->task = $task;
    }

    public function index()
    {
        return $this->task->all();
    }

    public function show($id)
    {
        return $this->task->findOrFail($id);
    }

    public function store(Request $request)
    {
        if ($request->has('file')) {
            $file = $request->file;
            $name = Str::random(10);
            $url = Storage::putFileAs('files', $file, $name . '.' . $file->extension());
            return $this->task::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'file' => $url,
                'user_id' => $request->input('user_id'),
                'type_id'=> $request->input('type_id'),
            ]);
        }
        else{
            return $this->task::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'user_id' => $request->input('user_id'),
                'type_id'=> $request->input('type_id'),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $task = $this->task->find($id);
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
            return $task;
        }
        else{
            $task->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'user_id' => $request->input('user_id'),
                'type_id'=> $request->input('type_id'),
            ]);
            return $task;
        }
    }

    public function destroy($id)
    {
        $this->task->destroy($id);
    }
}
