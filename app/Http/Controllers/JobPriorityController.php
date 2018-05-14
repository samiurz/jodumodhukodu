<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobPriority;
use App\Http\Resources\JobPriority as JobPriorityResource;

class JobPriorityController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get jobPriorities
        $jobPriorities = JobPriority::with('company')->orderBy('created_at', 'desc')->paginate(15);

        // Return collection of jobPriorities as a resource
        return JobPriorityResource::collection($jobPriorities);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jobPriorities = $request->isMethod('put') ? JobPriority::findOrFail($request->id) : new JobPriority;

        $jobPriorities->id = $request->input('id');
        $jobPriorities->company_id = $request->input('company_id');
        $jobPriorities->priority = $request->input('priority');
        $jobPriorities->comments = $request->input('comments');
        $jobPriorities->is_enabled = $request->input('is_enabled');
        $jobPriorities->created_by = $request->input('created_by');
        $jobPriorities->update_by = $request->input('update_by');
        if($jobPriorities->save()) {
            return new JobPriorityResource($jobPriorities);
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
        // Get jobPriorities
        $jobPriorities = JobPriority::findOrFail($id);

        // Return single jobPriorities as a resource
        return new JobPriorityResource($jobPriorities);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get jobPriorities
        $jobPriorities = JobPriority::findOrFail($id);

        if($jobPriorities->delete()) {
            return new JobPriorityResource($jobPriorities);
        }    
    }
}
