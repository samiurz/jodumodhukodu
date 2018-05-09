<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;
use App\Http\Resources\Asset as AssetResource;

class AssetController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get assets
        $assets = Asset::orderBy('created_at','desc')->paginate(15);

        // Return collection of assets as a resource
        return AssetResource::collection($assets);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $assets = $request->isMethod('put') ? Asset::findOrFail($request->id) : new Asset;

        $assets->id = $request->input('id');
        $assets->company_id = $request->input('company_id');
        $assets->asset_model_id = $request->input('asset_model_id');
        $assets->name = $request->input('name');
        $assets->serial = $request->input('serial');
        $assets->type = $request->input('type');
        $assets->label_id = $request->input('label_id');
        $assets->label_value = $request->input('label_value');
        $assets->description = $request->input('description');
        $assets->quality_id = $request->input('quality_id');
        $assets->manufacturer_id = $request->input('manufacturer_id');
        $assets->cost = $request->input('cost');
        $assets->asset_location_id = $request->input('asset_location_id');
        $assets->image = $request->input('image');
        $assets->current_stock = $request->input('current_stock');
        $assets->minimum_stock = $request->input('minimum_stock');
        $assets->comments = $request->input('comments');
        $assets->update_by = $request->input('update_by');
        if($assets->save()) {
            return new AssetResource($assets);
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
        // Get assets
        $assets = Asset::findOrFail($id);

        // Return single assets as a resource
        return new AssetResource($assets);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get assets
        $assets = Asset::findOrFail($id);

        if($assets->delete()) {
            return new AssetResource($assets);
        }    
    }
}
