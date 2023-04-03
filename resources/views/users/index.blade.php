@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Tasks List') }}
                </h2>
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Active</th>
                        <th width="120px"></th>

                    </tr>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role == 1) {{ __('Member') }}
                            @else {{ __('Admin') }}
                            @endif
                        </td>
                        <td>
                            @if($user->status == 1) <?php echo '<i style="color: #26bc2f;" class="fa-solid fa-circle-check"></i>'?>
                            @else <?php echo "<p>Unactive</p>"?>
                            @endif
                        </td>
                        <td>
                            <form action="" method="POST">
                                <a class="btn btn-outline-info" href="{{ route('users.show',$user->id) }}"><i class="fa-regular fa-eye"></i></a>
                                @if($user->role != 0)
                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')"><i class="fa-sharp fa-solid fa-trash"></i></button>
                                @endif
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection