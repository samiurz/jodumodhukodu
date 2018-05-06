<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobType;
use App\Http\Resources\JobType as JobTypeResource;

class JobTypeController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get jobTypes
        $jobTypes = JobType::with('company')->orderBy('created_at', 'desc')->paginate(15);

        // Return collection of jobTypes as a resource
        return JobTypeResource::collection($jobTypes);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jobTypes = $request->isMethod('put') ? JobType::findOrFail($request->id) : new JobType;

        $jobTypes->id = $request->input('id');
        $jobTypes->company_id = $request->input('company_id');
        $jobTypes->type = $request->input('type');
        $jobTypes->comments = $request->input('comments');
        $jobTypes->update_by = $request->input('update_by');
        
        if($jobTypes->save()) {
            return new JobTypeResource($jobTypes);
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
        // Get jobTypes
        $jobTypes = JobType::findOrFail($id);

        // Return single jobTypes as a resource
        return new JobTypeResource($jobTypes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get jobTypes
        $jobTypes = JobType::findOrFail($id);

        if($jobTypes->delete()) {
            return new JobTypeResource($jobTypes);
        }    
    }
}
