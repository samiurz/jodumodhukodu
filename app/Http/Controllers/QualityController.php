<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quality;
use App\Http\Resources\Quality as QualityResource;

class QualityController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get qualities
        $qualities = Quality::orderBy('created_at', 'desc')->paginate(15);

        // Return collection of qualities as a resource
        return QualityResource::collection($qualities);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $qualities = $request->isMethod('put') ? Quality::findOrFail($request->id) : new Quality;

        $qualities->id = $request->input('id');
        $qualities->name = $request->input('name');
        $qualities->comments = $request->input('comments');
        $qualities->is_enabled = $request->input('is_enabled');
        $qualities->created_by = $request->input('created_by');
        $qualities->update_by = $request->input('update_by');
        
        if($qualities->save()) {
            return new QualityResource($qualities);
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
        // Get qualities
        $qualities = Quality::findOrFail($id);

        // Return single qualities as a resource
        return new QualityResource($qualities);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get qualities
        $qualities = Quality::findOrFail($id);

        if($qualities->delete()) {
            return new QualityResource($qualities);
        }    
    }
}
