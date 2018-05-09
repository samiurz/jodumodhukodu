<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\Http\Resources\Document as DocumentResource;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get documents
        $documents = Document::orderBy('created_at', 'desc')->paginate(15);

        // Return collection of documents as a resource
        return DocumentResource::collection($documents);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $documents = $request->isMethod('put') ? Document::findOrFail($request->id) : new Document;

        $documents->id = $request->input('id');
        $documents->company_id = $request->input('company_id');
        $documents->documentation_types_id = $request->input('documentation_types_id');
        $documents->file = $request->input('file');
        $documents->url = $request->input('url');
        $documents->update_by = $request->input('update_by');
        if($documents->save()) {
            return new DocumentResource($documents);
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
        // Get documents
        $documents = Document::findOrFail($id);

        // Return single documents as a resource
        return new DocumentResource($documents);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get documents
        $documents = Document::findOrFail($id);

        if($documents->delete()) {
            return new DocumentResource($documents);
        }    
    }
}
