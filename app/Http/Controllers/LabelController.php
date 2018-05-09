<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Label;
use App\Http\Resources\Label as LabelResource;

class LabelController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get labels
        $labels = Label::with('company')->orderBy('created_at', 'desc')->paginate(15);

        // Return collection of labels as a resource
        return LabelResource::collection($labels);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $labels = $request->isMethod('put') ? Label::findOrFail($request->id) : new Label;

        $labels->id = $request->input('id');
        $labels->company_id = $request->input('company_id');
        $labels->name = $request->input('name');
        $labels->comments = $request->input('comments');
        $labels->update_by = $request->input('update_by');
        
        if($labels->save()) {
            return new LabelResource($labels);
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
        // Get labels
        $labels = Label::findOrFail($id);

        // Return single labels as a resource
        return new LabelResource($labels);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get labels
        $labels = Label::findOrFail($id);

        if($labels->delete()) {
            return new LabelResource($labels);
        }    
    }
}
