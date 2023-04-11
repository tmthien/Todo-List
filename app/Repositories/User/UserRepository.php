<?php

namespace App\Repositories\User;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    private User $user;
    public function __construct(User $user) 
    {
        $this->user = $user;
    }

    public function index()
    {
        return $this->user->all();
    }

    public function show($id)
    {
        return $this->user->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $user = $this->user->find($id);
        if($user) {
            $user->update([
                'status' => $request->status,
            ]);
            return $user;
        }
    }

}
