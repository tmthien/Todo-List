<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'file',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function unAssign(){
        $tasks = Task::all();
        foreach($tasks as $task) {
            if($task->user_id == 1) return true;
            else return false;
        }
    }
    
    public function checkMyTask() {
        if($this->user_id == auth()->user()->id) return true;
        else return false;
    }
}
