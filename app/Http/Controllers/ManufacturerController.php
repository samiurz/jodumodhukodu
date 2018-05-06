<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manufacturer;
use App\Http\Resources\Manufacturer as ManufacturerResource;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get manufacturers
        $manufacturers = Manufacturer::orderBy('created_at', 'desc')->paginate(15);

        // Return collection of manufacturers as a resource
        return ManufacturerResource::collection($manufacturers);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $manufacturers = $request->isMethod('put') ? Manufacturer::findOrFail($request->id) : new Manufacturer;

        $manufacturers->id = $request->input('id');
        $manufacturers->company_id = $request->input('company_id');
        $manufacturers->name = $request->input('name');
        $manufacturers->comments = $request->input('comments');
        $manufacturers->update_by = $request->input('update_by');
        
        if($manufacturers->save()) {
            return new ManufacturerResource($manufacturers);
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
        // Get manufacturers
        $manufacturers = Manufacturer::findOrFail($id);

        // Return single manufacturers as a resource
        return new ManufacturerResource($manufacturers);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get manufacturers
        $manufacturers = Manufacturer::findOrFail($id);

        if($manufacturers->delete()) {
            return new ManufacturerResource($manufacturers);
        }    
    }
}
