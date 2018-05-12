<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerBlockModuleAction;
use App\Http\Resources\CustomerBlockModuleAction as CustomerBlockModuleActionResource;

class CustomerBlockModuleActionController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get CustomerBlockModuleAction
        $CustomerBlockModuleActions = CustomerBlockModuleAction::orderBy('created_at', 'desc')->paginate(15);

        // Return collection of CustomerBlockModuleAction as a resource
        return CustomerBlockModuleActionResource::collection($CustomerBlockModuleAction);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $CustomerBlockModuleActions = $request->isMethod('put') ? CustomerBlockModuleAction::findOrFail($request->id) : new CustomerBlockModuleAction;

        $CustomerBlockModuleActions->id = $request->input('id');
        $CustomerBlockModuleActions->contact_id = $request->input('contact_id');
        $CustomerBlockModuleActions->customer_block_id = $request->input('customer_block_id');
        $CustomerBlockModuleActions->module_id = $request->input('module_id');
        $CustomerBlockModuleActions->activity_id = $request->input('activity_id');
        $CustomerBlockModuleActions->comments = $request->input('comments');
        $CustomerBlockModuleActions->update_by = $request->input('update_by');
        if($CustomerBlockModuleActions->save()) {
            return new CustomerBlockModuleActionResource($CustomerBlockModuleAction);
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
        // Get CustomerBlockModuleAction
        $customerBlockModuleActions = CustomerBlockModuleAction::findOrFail($id);

        // Return single CustomerBlockModuleAction as a resource
        return new CustomerBlockModuleActionResource($CustomerBlockModuleAction);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get CustomerBlockModuleAction
        $customerBlockModuleActions = CustomerBlockModuleAction::findOrFail($id);

        if($customerBlockModuleActions->delete()) {
            return new CustomerBlockModuleActionResource($CustomerBlockModuleAction);
        }    
    }
}
