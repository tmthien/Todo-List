@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div style="display: flex; justify-content: space-between; padding-bottom: 10px;">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Profile') }}
                    </h2>
                    <div>
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('profile.index') }}">Back</a>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <form method="POST" action="{{ route('profile.update',auth()->id()) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <strong for="name" class="form-label">Name: </strong>
                                <input name="name" type="text" value="{{ auth()->user()->name }}">
                            </div>
                            <div class="col-md-6">
                                <strong for="email" class="form-label">Email: </strong>
                                <input name="email" type="text" value="{{ auth()->user()->email }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
