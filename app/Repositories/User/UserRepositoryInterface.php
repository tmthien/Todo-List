<?php

namespace App\Repositories\User;

use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function index();
    public function show($id);
    public function update(Request $request, $id);
}