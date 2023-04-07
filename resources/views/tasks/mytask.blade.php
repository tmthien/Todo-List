@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div style="display: flex; justify-content: space-between; padding-bottom: 10px;">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Tasks List') }}
                    </h2>
                    @if($user->role == 0)
                    <a class="btn btn-sm btn-outline-success" href="{{ route('tasks.create') }}">Add new task</a>
                    @endif
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Assign</th>
                        <th>Status</th>
                        <th width="50px"></th>
                    </tr>
                    @foreach ($tasks as $task)
                        @if($task->user_id == auth()->id())
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $task->title }}</td> 
                            <td>
                                <?php echo $task->description?> 
                            </td> 
                            <td>{{ $task->user->name }}</td>
                            <td>{{ ucfirst($task->status) }}</td> 
                            <td>
                                <a class="btn btn-sm btn-outline-info" href="{{ route('mytasks.show',$task->id) }}"><i class="fa-regular fa-eye"></i></a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </table>
                {!! $tasks->links() !!}

            </div>
        </div>
    </div>
</div>
@endsection