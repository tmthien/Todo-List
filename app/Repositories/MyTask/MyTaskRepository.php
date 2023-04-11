<?php 

namespace App\Repositories\MyTask;

use App\Models\Task;
use App\Repositories\MyTask\MyTaskRepositoryInterFace;
use Illuminate\Http\Request;

class MyTaskRepository implements MyTaskRepositoryInterFace
{
    private Task $task;
    public function __construct(Task $task) 
    {
        $this->task = $task;
    }

    public function index($id)
    {
        $tasks =  $this->task->where('user_id', $id)->get();
        return $tasks;
    }

    public function show($id)
    {
        return $this->task->findOrFail($id);
    }


    public function update(Request $request, $id)
    {
        $task = $this->task->find($id);
        if($task){
            $task->update([
                'status'=> $request->status
            ]);
            return $task;
        }
    }

}
