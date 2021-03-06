<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Http\Resources\Contact as ContactResource;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get contacts
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(15);

        // Return collection of contacts as a resource
        return ContactResource::collection($contacts);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contacts = $request->isMethod('put') ? Contact::findOrFail($request->id) : new Contact;

        $contacts->id = $request->input('id');
        $contacts->company_id = $request->input('company_id');
        $contacts->name = $request->input('name');
        $contacts->phone = $request->input('phone');
        $contacts->links = $request->input('links');
        $contacts->email = $request->input('email');
        $contacts->password = $request->input('password');
        $contacts->is_enabled = $request->input('is_enabled');
        $contacts->created_by = $request->input('created_by');
        $contacts->update_by = $request->input('update_by');

        if($contacts->save()) {
            return new ContactResource($contacts);
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
        // Get contacts
        $contacts = Contact::findOrFail($id);

        // Return single contacts as a resource
        return new ContactResource($contacts);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get contacts
        $contacts = Contact::findOrFail($id);

        if($contacts->delete()) {
            return new ContactResource($contacts);
        }    
    }
    
    /**
     * Display the specified resource.
     *$
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function contactsByCompanyId($id)
    {
        // Get contacts by company id
        $contactsByCompany = Contact::where('company_id', $id)->get();

        // Return collection of contacts as a resource
        return ContactResource::collection($contactsByCompany);
    }
}
