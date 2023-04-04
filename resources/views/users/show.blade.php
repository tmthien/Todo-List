@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div style="display: flex; justify-content: space-between;">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Member Detail') }}
                    </h2>
                    <a class="btn btn-outline-primary" href="{{ route('users.index') }}"> Back</a>
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
                        <strong>Name:</strong>
                        {{ $user->name }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        {{ $user->email }}
                    </div>
                </div>
                @if($roleUser->role == 0)
                    @if($user->id !=1 && $user->status == 1)
                        <div class="col-md-12 text-center">
                            <form action="{{ route('users.update',$user->id) }}" method="POST">
                                @csrf
                                @method("PUT")
                                <input type="hidden" name="status" value="0">
                                <button type="submit" class="btn btn-outline-danger">Disable Member</button>
                            </form>
                        </div>
                    @endif
                    @if($user->status == 0)
                        <div class="col-md-12 text-center">
                            <form action="{{ route('users.update',$user->id) }}" method="POST">
                                @csrf
                                @method("PUT")
                                <input type="hidden" name="status" value="1">
                                <button type="submit" class="btn btn-outline-success">Active Member</button>
                            </form>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection