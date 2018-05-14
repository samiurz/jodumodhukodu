<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spare;
use App\Http\Resources\Spare as SpareResource;
class SpareController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get spare
        $spare = Spare::orderBy('created_at', 'desc')->paginate(15);

        // Return collection of spare as a resource
        return SpareResource::collection($spare);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $spare = $request->isMethod('put') ? Spare::findOrFail($request->id) : new Spare;

        $spare->id = $request->input('id');
        $spare->company_id = $request->input('company_id');
        $spare->asset_id = $request->input('asset_id');
        $spare->name = $request->input('name');
        $spare->serial = $request->input('serial');
        $spare->cost = $request->input('cost');
        $spare->image = $request->input('image');
        $spare->description = $request->input('description');
        $spare->manufacturar_id = $request->input('manufacturar_id');
        $spare->minimum_stock = $request->input('minimum_stock');
        $spare->current_stock = $request->input('current_stock');
        $spare->comments = $request->input('comments');
        $spare->is_enabled = $request->input('is_enabled');
        $spare->created_by = $request->input('created_by');
        $spare->update_by = $request->input('update_by');

        if($spare->save()) {
            return new SpareResource($spare);
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
        // Get spare
        $spare = Spare::findOrFail($id);

        // Return single spare as a resource
        return new SpareResource($spare);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get spare
        $spare = Spare::findOrFail($id);

        if($spare->delete()) {
            return new SpareResource($spare);
        }    
    }
}
