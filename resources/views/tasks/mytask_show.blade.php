@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div style="display: flex; justify-content: space-between;">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Task Detail') }}
                    </h2>
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('mytasks.index') }}"> Back</a>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
            </div>
            <div class="row p-6">
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Title:</strong>
                        {{ $task->title }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <?php 
                            echo $task->description;
                        ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Assigned to:</strong>
                        {{ optional($task->user)->name }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Type of Task:</strong>
                        {{ optional($task->type)->name }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Status:</strong>
                        {{ ucfirst($task->status) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Update status</strong>
                        <form action="{{ route('mytasks.update', $task->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" id="" class="form-control">
                                <option value="pending">Peding</option>
                                <option value="processing">Processing</option>
                                <option value="complete">Complete</option>
                            </select>
                            <button class="m-3 btn btn-sm btn-outline-info" type="submit">Update Status</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>File:</strong>
                        <a href="{{ route('downloadFile', $task->id) }}">{{ $task->file }}</a> 
                    </div>
                </div>
                <div class="col-md-12 border">
                    @if(isset($comment))
                        @include('tasks._comment_replies', ['comments' => $task->comments, 'task_id' => $task->id])
                    @endif
                </div>
                <div class="col-md-12 border">
                    <form action="{{ route('comments.create') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <strong>Comment:</strong>
                            <input type="text" name="body" class="form-control"/>
                            <input type="hidden" name="task_id" value="{{ $task->id }}" />
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}"/>
                            <div class="form-group pt-2">
                                <input type="submit" class="btn btn-sm btn-warning" value="Comment" />
                            </div>
                        </div>
                    </form>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection
