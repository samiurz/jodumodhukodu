<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DocumentationType;
use App\Http\Resources\DocumentationType as DocumentationTypeResource;

class DocumentationTypeController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get documentationTypes
        $documentationTypes = DocumentationType::orderBy('created_at', 'desc')->paginate(15);

        // Return collection of documentationTypes as a resource
        return DocumentationTypeResource::collection($documentationTypes);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $documentationTypes = $request->isMethod('put') ? DocumentationType::findOrFail($request->id) : new DocumentationType;

        $documentationTypes->id = $request->input('id');
        $documentationTypes->company_id = $request->input('company_id');
        $documentationTypes->type = $request->input('type');
        $documentationTypes->comments = $request->input('comments');
        $documentationTypes->update_by = $request->input('update_by');
        if($documentationTypes->save()) {
            return new DocumentationTypeResource($documentationTypes);
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
        // Get documentationTypes
        $documentationTypes = DocumentationType::findOrFail($id);

        // Return single documentationTypes as a resource
        return new DocumentationTypeResource($documentationTypes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get documentationTypes
        $documentationTypes = DocumentationType::findOrFail($id);

        if($documentationTypes->delete()) {
            return new DocumentationTypeResource($documentationTypes);
        }    
    }
}
