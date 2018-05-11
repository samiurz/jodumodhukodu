<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssetLocation;
use App\Http\Resources\AssetLocation as AssetLocationResource;

class AssetLocationController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get assetLocations
        $assetLocations = AssetLocation::orderBy('created_at', 'desc')->paginate(15);

        // Return collection of assetLocations as a resource
        return AssetLocationResource::collection($assetLocations);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $assetLocations = $request->isMethod('put') ? AssetLocation::findOrFail($request->id) : new AssetLocation;

        $assetLocations->id = $request->input('id');
        $assetLocations->company_id = $request->input('company_id');
        $assetLocations->location = $request->input('location');
        $assetLocations->comments = $request->input('comments');
        $assetLocations->update_by = $request->input('update_by');
        
        if($assetLocations->save()) {
            return new AssetLocationResource($assetLocations);
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
        // Get assetLocations
        $assetLocations = AssetLocation::findOrFail($id);

        // Return single assetLocations as a resource
        return new AssetLocationResource($assetLocations);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get assetLocations
        $assetLocations = AssetLocation::findOrFail($id);

        if($assetLocations->delete()) {
            return new AssetLocationResource($assetLocations);
        }    
    }
}
