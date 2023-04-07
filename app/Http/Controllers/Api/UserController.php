<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return response()->json([
            'massage' => 'Get list User Successfully',
            'Users' => $users,
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json([
            'massage' => 'Get User by id Successfully',
            'Users' => $user,
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'status' => $request->status,
        ]);
        return response()->json([
            'massage' => 'Update status user Successfully',
            'User' => $user,
        ]);
    }
}
