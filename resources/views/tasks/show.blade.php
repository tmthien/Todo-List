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
                    <a class="btn btn-outline-primary" href="{{ route('tasks.index') }}"> Back</a>
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
                        {{ $task->description }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Assigned to:</strong>
                        @if($task->user_id != 1) {{ $task->user->name }}
                        @else <?php echo 'None' ?>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Status:</strong>
                        {{ $task->status }}
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection