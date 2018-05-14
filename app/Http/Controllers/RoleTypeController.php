<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\roletype;
use App\Http\Resources\roletype as roletypeResource;

class roletypeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get roletypes
        $roletypes = roletype::orderBy('created_at', 'desc')->paginate(15);

        // Return collection of roletypes as a resource
        return roletypeResource::collection($roletypes);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roletype = $request->isMethod('put') ? roletype::findOrFail($request->id) : new roletype;

        $roletype->id = $request->input('id');
        $roletype->name = $request->input('name');
        $roletype->comments = $request->input('comments');
        $roletype->is_enabled = $request->input('is_enabled');
        $roletype->created_by = $request->input('created_by');
        $roletype->update_by = $request->input('update_by');

        if($roletype->save()) {
            return new roletypeResource($roletype);
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
        // Get roletype
        $roletype = roletype::findOrFail($id);

        // Return single roletype as a resource
        return new roletypeResource($roletype);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get roletype
        $roletype = roletype::findOrFail($id);

        if($roletype->delete()) {
            return new roletypeResource($roletype);
        }    
    }
}
