<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccountBlockAssociation;
use App\Http\Resources\AccountBlockAssociation as AccountBlockAssociationResource;

class AccountBlockAssociationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get accountBlockAssociations
        $accountBlockAssociations = AccountBlockAssociation::orderBy('created_at', 'desc')->paginate(15);

        // Return collection of accountBlockAssociations as a resource
        return AccountBlockAssociationResource::collection($accountBlockAssociations);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $accountBlockAssociations = $request->isMethod('put') ? AccountBlockAssociation::findOrFail($request->id) : new AccountBlockAssociation;
        $accountBlockAssociations->id = $request->input('id');
        $accountBlockAssociations->account_id = $request->input('account_id');
        $accountBlockAssociations->block_id = $request->input('block_id');
        $accountBlockAssociations->block_stat_id = $request->input('block_stat_id');
        $accountBlockAssociations->comments = $request->input('comments');
        $accountBlockAssociations->is_enabled = $request->input('is_enabled');
        $accountBlockAssociations->created_by = $request->input('created_by');
        $accountBlockAssociations->update_by = $request->input('update_by');
        if($accountBlockAssociations->save()) {
            return new AccountBlockAssociationResource($accountBlockAssociations);
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
        // Get accountBlockAssociations
        $accountBlockAssociations = AccountBlockAssociation::findOrFail($id);

        // Return single accountBlockAssociations as a resource
        return new AccountBlockAssociationResource($accountBlockAssociations);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get accountBlockAssociations
        $accountBlockAssociations = AccountBlockAssociation::findOrFail($id);

        if($accountBlockAssociations->delete()) {
            return new AccountBlockAssociationResource($accountBlockAssociations);
        }    
    }
}
