<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RepairType;
use App\Http\Resources\RepairType as RepairTypeResource;

class RepairTypeController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get repairTypes
        $repairTypes = RepairType::orderBy('created_at', 'desc')->paginate(15);

        // Return collection of repairTypes as a resource
        return RepairTypeResource::collection($repairTypes);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $repairTypes = $request->isMethod('put') ? RepairType::findOrFail($request->id) : new RepairType;

        $repairTypes->id = $request->input('id');
        $repairTypes->company_id = $request->input('company_id');
        $repairTypes->type = $request->input('type');
        $repairTypes->comments = $request->input('comments');
        $repairTypes->is_enabled = $request->input('is_enabled');
        $repairTypes->created_by = $request->input('created_by');
        $repairTypes->update_by = $request->input('update_by');
        if($repairTypes->save()) {
            return new RepairTypeResource($repairTypes);
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
        // Get repairTypes
        $repairTypes = RepairType::findOrFail($id);

        // Return single repairTypes as a resource
        return new RepairTypeResource($repairTypes);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get repairTypes
        $repairTypes = RepairType::findOrFail($id);

        if($repairTypes->delete()) {
            return new RepairTypeResource($repairTypes);
        }    
    }
}
