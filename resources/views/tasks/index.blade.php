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
                        <th width="130px"></th>
                    </tr>
                    @foreach ($tasks as $task)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $task->title }}</td> {{-- Hiển thị title trong bảng task --}}
                        <td><?php echo $task->description ?></td> {{-- Hiển thị description trong bảng task --}}
                        <td> 
                            @if($task->user_id != 1) {{ $task->user->name }}
                            @else <?php echo 'None' ?>
                            @endif
                        </td>
                        <td>{{ ucfirst($task->status) }}</td> {{-- Hiển thị status trong bảng task --}}
                        <td>
                            <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">
                                <a class="btn btn-sm btn-outline-info" href="{{ route('tasks.show',$task->id) }}"><i class="fa-regular fa-eye"></i></a>
                                @if($user->role == 0)
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('tasks.edit',$task->id) }}"><i class="fa-sharp fa-regular fa-pen-to-square"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')"><i class="fa-sharp fa-solid fa-trash"></i></button>
                                @endif
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {!! $tasks->links() !!}

            </div>
        </div>
    </div>
</div>
@endsection