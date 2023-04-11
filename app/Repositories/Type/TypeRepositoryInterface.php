<?php

namespace App\Repositories\Type;

use Illuminate\Http\Request;

interface TypeRepositoryInterface
{
    public function index();
    public function show($id);
    public function store(Request $request);
    public function update(Request $request, $id);
    public function destroy($id);
}