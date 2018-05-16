<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssetModel;
use App\Http\Resources\AssetModel as AssetModelResource;

class AssetModelController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get assetModels
        $assetModels = AssetModel::orderBy('created_at', 'desc')->paginate(15);

        // Return collection of assetModels as a resource
        return AssetModelResource::collection($assetModels);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $assetModels = $request->isMethod('put') ? AssetModel::findOrFail($request->id) : new AssetModel;

        $assetModels->id = $request->input('id');
        $assetModels->company_id = $request->input('company_id');
        $assetModels->model_type_id = $request->input('model_type_id');
        $assetModels->name = $request->input('name');
        $assetModels->image = $request->input('image');
        $assetModels->rent = $request->input('rent');
        $assetModels->frequency = $request->input('frequency');
        $assetModels->minimum_stock = $request->input('minimum_stock');
        $assetModels->current_stock = $request->input('current_stock');
        $assetModels->comments = $request->input('comments');
        $assetModels->is_enabled = $request->input('is_enabled');
        $assetModels->created_by = $request->input('created_by');
        $assetModels->update_by = $request->input('update_by');
        if($assetModels->save()) {
            return new AssetModelResource($assetModels);
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
        // Get assetModels
        $assetModels = AssetModel::findOrFail($id);

        // Return single assetModels as a resource
        return new AssetModelResource($assetModels);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get assetModels
        $assetModels = AssetModel::findOrFail($id);

        if($assetModels->delete()) {
            return new AssetModelResource($assetModels);
        }    
    }
}
