@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div style="display: flex; justify-content: space-between; padding-bottom: 10px;">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Types List') }}
                    </h2>
                    @if(auth()->user()->isAdmin())
                        <a class="btn btn-sm btn-outline-success" href="{{ route('types.create') }}">Add new type</a>
                    @endif
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th width="100px"></th>

                    </tr>
                    @foreach($types as $type)
                    <tr>
                        <td>{{ $type->id }}</td>
                        <td>{{ $type->name }}</td>
                        <td>
                            <form action="{{ route('types.destroy', $type->id) }}" method="POST">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('types.edit',$type->id) }}"><i class="fa-sharp fa-regular fa-pen-to-square"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')"><i class="fa-sharp fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {!! $types->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
