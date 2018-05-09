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
        // Get assetmodels
        $assetmodels = AssetModel::orderBy('created_at', 'desc')->paginate(15);

        // Return collection of assetmodels as a resource
        return AssetModelResource::collection($assetmodels);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $assetmodels = $request->isMethod('put') ? AssetModel::findOrFail($request->id) : new AssetModel;

        $assetmodels->id = $request->input('id');
        $assetmodels->company_id = $request->input('company_id');
        $assetmodels->model_type_id = $request->input('model_type_id');
        $assetmodels->name = $request->input('name');
        $assetmodels->image = $request->input('image');
        $assetmodels->rent = $request->input('rent');
        $assetmodels->frequency = $request->input('frequency');
        $assetmodels->minimum_stock = $request->input('minimum_stock');
        $assetmodels->current_stock = $request->input('current_stock');
        $assetmodels->comments = $request->input('comments');
        $assetmodels->update_by = $request->input('update_by');
        if($assetmodels->save()) {
            return new AssetModelResource($assetmodels);
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
        // Get assetmodels
        $assetmodels = AssetModel::findOrFail($id);

        // Return single assetmodels as a resource
        return new AssetModelResource($assetmodels);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get assetmodels
        $assetmodels = AssetModel::findOrFail($id);

        if($assetmodels->delete()) {
            return new AssetModelResource($assetmodels);
        }    
    }
}
