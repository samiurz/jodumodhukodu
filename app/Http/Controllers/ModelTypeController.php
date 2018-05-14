<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelType;
use App\Http\Resources\ModelType as ModelTypeResource;

class ModelTypeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get modelTypes
        $modelTypes = ModelType::with('company')->orderBy('created_at', 'desc')->paginate(15);

        // Return collection of modelTypes as a resource
        return ModelTypeResource::collection($modelTypes);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $modelTypes = $request->isMethod('put') ? ModelType::findOrFail($request->id) : new ModelType;

        $modelTypes->id = $request->input('id');
        $modelTypes->company_id = $request->input('company_id');
        $modelTypes->make = $request->input('make');
        $modelTypes->type = $request->input('type');
        $modelTypes->comments = $request->input('comments');
        $modelTypes->is_enabled = $request->input('is_enabled');
        $modelTypes->created_by = $request->input('created_by');
        $modelTypes->update_by = $request->input('update_by');
        if($modelTypes->save()) {
            return new ModelTypeResource($modelTypes);
        }
        
    }
    /**
     * Display the specified resource.
     *$
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get modelTypes
        $modelTypes = ModelType::findOrFail($id);

        // Return single modelTypes as a resource
        return new ModelTypeResource($modelTypes);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get modelTypes
        $modelTypes = ModelType::findOrFail($id);

        if($modelTypes->delete()) {
            return new ModelTypeResource($modelTypes);
        }    
    }
}
