<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlockStat;
use App\Http\Resources\BlockStat as BlockStatResource;

class BlockStatController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get blockStats
        $blockStats = BlockStat::orderBy('created_at', 'desc')->paginate(15);

        // Return collection of blockStats as a resource
        return BlockStatResource::collection($blockStats);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blockStats = $request->isMethod('put') ? BlockStat::findOrFail($request->id) : new BlockStat;

        $blockStats->id = $request->input('id');
        $blockStats->name = $request->input('name');
        $blockStats->comments = $request->input('comments');
        $blockStats->is_enabled = $request->input('is_enabled');
        $blockStats->created_by = $request->input('created_by');
        $blockStats->update_by = $request->input('update_by');
        if($blockStats->save()) {
            return new BlockStatResource($blockStats);
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
        // Get blockStats
        $blockStats = BlockStat::findOrFail($id);

        // Return single blockStats as a resource
        return new BlockStatResource($blockStats);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get blockStats
        $blockStats = BlockStat::findOrFail($id);

        if($blockStats->delete()) {
            return new BlockStatResource($blockStats);
        }    
    }
}
