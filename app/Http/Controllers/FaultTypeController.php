<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FaultType;
use App\Http\Resources\FaultType as FaultTypeResource;

class FaultTypeController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get faultTypes
        $faultTypes = FaultType::with('company')->orderBy('created_at', 'desc')->paginate(15);

        // Return collection of faultTypes as a resource
        return FaultTypeResource::collection($faultTypes);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $faultTypes = $request->isMethod('put') ? FaultType::findOrFail($request->id) : new FaultType;

        $faultTypes->id = $request->input('id');
        $faultTypes->company_id = $request->input('company_id');
        $faultTypes->asset_id = $request->input('asset_id');
        $faultTypes->type = $request->input('type');
        $faultTypes->comments = $request->input('comments');
        $faultTypes->is_enabled = $request->input('is_enabled');
        $faultTypes->created_by = $request->input('created_by');
        $faultTypes->update_by = $request->input('update_by');
        if($faultTypes->save()) {
            return new FaultTypeResource($faultTypes);
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
        // Get faultTypes
        $faultTypes = FaultType::findOrFail($id);

        // Return single faultTypes as a resource
        return new FaultTypeResource($faultTypes);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get faultTypes
        $faultTypes = FaultType::findOrFail($id);

        if($faultTypes->delete()) {
            return new FaultTypeResource($faultTypes);
        }    
    }
}
