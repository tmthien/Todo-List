<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function add(Request $request) {
        // dd($request);
        $comment = new Comment;
        $comment->body = $request->get('body');
        $comment->user()->associate($request->user());
        $task = Task::find($request->get('task_id'));
        $task->comments()->save($comment);
        return back();
    }

    public function reply(Request $request)
    {
        $reply = new Comment();
        $reply->body = $request->get('body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $task = Task::find($request->get('task_id'));
        $task->comments()->save($reply);
        return back();
    }
}
