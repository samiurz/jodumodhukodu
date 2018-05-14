<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SpareType;
use App\Http\Resources\SpareType as SpareTypeResource;

class SpareTypeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get spareTypes
        $spareTypes = SpareType::with('company')->orderBy('created_at', 'desc')->paginate(15);

        // Return collection of spareTypes as a resource
        return SpareTypeResource::collection($spareTypes);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $spareTypes = $request->isMethod('put') ? SpareType::findOrFail($request->id) : new SpareType;

        $spareTypes->id = $request->input('id');
        $spareTypes->company_id = $request->input('company_id');
        $spareTypes->type = $request->input('type');
        $spareTypes->comments = $request->input('comments');
        $spareTypes->is_enabled = $request->input('is_enabled');
        $spareTypes->created_by = $request->input('created_by');
        $spareTypes->update_by = $request->input('update_by');
        
        if($spareTypes->save()) {
            return new SpareTypeResource($spareTypes);
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
        // Get spareTypes
        $spareTypes = SpareType::findOrFail($id);

        // Return single spareTypes as a resource
        return new SpareTypeResource($spareTypes);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get spareTypes
        $spareTypes = SpareType::findOrFail($id);

        if($spareTypes->delete()) {
            return new SpareTypeResource($spareTypes);
        }    
    }
}
