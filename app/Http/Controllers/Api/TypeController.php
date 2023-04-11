<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TypeResource;
use App\Models\Type;
use App\Repositories\Type\TypeRepositoryInterface;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    private TypeRepositoryInterface $typeRepository;

    public function __construct(TypeRepositoryInterface $typeRepository) 
    {
        $this->typeRepository = $typeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = $this->typeRepository->index();
        return response()->json([
            TypeResource::collection($types), 
            'Get list type Successfully.'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = $this->typeRepository->store($request);
        return response()->json(['Type created successfully.', new TypeResource($type)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = $this->typeRepository->show($id);
        if(is_null($type)){
            return response()->json('Type not found', 404);
        }
        return response()->json(new TypeResource($type));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $type = $this->typeRepository->update($request, $id);
        if(is_null($type)){
            return response()->json('Update type failed', 404);
        }
        return response()->json(new TypeResource($type));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->typeRepository->destroy($id);
        return response()->json('Type deleted successfully');
    }
}
