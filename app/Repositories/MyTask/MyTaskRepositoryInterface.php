<?php

namespace App\Repositories\MyTask;

use Illuminate\Http\Request;

interface MyTaskRepositoryInterFace
{
    public function index($id);
    public function show($id);
    public function update(Request $request, $id);
}
