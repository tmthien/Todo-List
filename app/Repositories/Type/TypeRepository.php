<?php

namespace App\Repositories\Type;

use App\Repositories\Type\TypeRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Type;

class TypeRepository implements TypeRepositoryInterface
{
    private Type $type;
    public function __construct(Type $type) 
    {
        $this->type = $type;
    }

    public function index()
    {
        return $this->type->all();
    }

    public function show($id)
    {
        return $this->type->findOrFail($id);
    }

    public function store(Request $request){
        return $this->type->create([
            'name' => $request->name,
        ]);
    }

    public function update(Request $request, $id)
    {
        $type = $this->type->find($id);
        if($type) {
            $type->update([
                'name' => $request->name,
            ]);
            return $type;
        }
    }

    public function destroy($id)
    {
        $this->type->destroy($id);
    }

}
