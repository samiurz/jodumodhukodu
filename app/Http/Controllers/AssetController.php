<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;
use App\Http\Resources\Asset as AssetResource;

use App\FileManagement\Props;
use App\FileManagement\Repositories\Attachment\AttachmentRepository;
use Auth;
use Exception;

class AssetController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get assets
        $assets = Asset::orderBy('created_at','desc')->paginate(15);

        // Return collection of assets as a resource
        return AssetResource::collection($assets);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $assets = $request->isMethod('put') ? Asset::findOrFail($request->id) : new Asset;

        $assets->id = $request->input('id');
        $assets->company_id = $request->input('company_id');
        $assets->asset_model_id = $request->input('asset_model_id');
        $assets->name = $request->input('name');
        $assets->serial = $request->input('serial');
        //$assets->type = $request->input('type');
        $assets->label_id = $request->input('label_id');
        $assets->label_value = $request->input('label_value');
        $assets->description = $request->input('description');
        $assets->quality_id = $request->input('quality_id');
        $assets->manufacturer_id = $request->input('manufacturer_id');
        $assets->cost = $request->input('cost');
        $assets->asset_location_id = $request->input('asset_location_id');
        $assets->asset_status_id = $request->input('asset_status_id');
        $assets->image = $request->input('image');
        $assets->current_stock = $request->input('current_stock');
        $assets->minimum_stock = $request->input('minimum_stock');
        $assets->comments = $request->input('comments');
        $assets->is_enabled = $request->input('is_enabled');
        $assets->created_by = $request->input('created_by');
        $assets->update_by = $request->input('update_by');
        if($assets->save()) {
            return new AssetResource($assets);
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
        // Get assets
        $assets = Asset::findOrFail($id);

        // Return single assets as a resource
        return new AssetResource($assets);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get assets
        $assets = Asset::findOrFail($id);

        if($assets->delete()) {
            return new AssetResource($assets);
        }    
    }


    /**
     * AttachmentRepository instance
     *
     * @var App\FileManagement\Repositories\AttachmentRepository
     **/
    protected $attachmentRepo;

    public function __construct(AttachmentRepository $attachmentRepo)
    {
        $this->attachmentRepo = $attachmentRepo;
    }

    /**
     * Delete an attachment
     * 
     * @param  Request $request 
     * @return Response           
     */
    public function deleteAttachment(Request $request)
    {
        try {

            if (!Auth::check()) {
                throw new Exception("User has to be logged in", 1);
            }

            $attachment_id = $request->input('attachment_id');

            if (!$attachment_id) {
                throw new Exception("You are trying to delete a non-existing file", 1);
            }

            $attachment = $this->attachmentRepo->delete(intval($attachment_id));

            return response()->json(array(
                'success' => true,
                'data' => $attachment,
                'errors' => []
            ), 200);

        } catch(\Exception $e) {

            return response()->json(array(
                'success' => false,
                'data' => 'Server error happened',
                'errors' => $e->getMessage()
            ), 200);

        }
    }

    /**
     * Pull all the attachments for the logged in user
     * 
     * @param  Request $request 
     * @return Response           
     */
    public function pullAttachments(Request $request)
    {   
        try {

            // if (!Auth::check()) {
            //     throw new Exception("User has to be logged in", 1);
            // }

            // $user_id = Auth::user()->id;

            $attachments = $this->attachmentRepo->orderBy('created_at', 'DESC')->all();

            return response()->json(array(
                'success' => true,
                'data' => $attachments,
                'errors' => []
            ), 200);

        } catch(\Exception $e) {

            return response()->json(array(
                'success' => false,
                'data' => 'Server error happened',
                'errors' => $e->getMessage()
            ), 200);

        }
    }

    /**
     * Store files locally
     * 
     * @param  Request $request 
     * @return Response           
     */
    public function storeAttachments(Request $request)
    {
    	try {

            $attachments = $this->processAttachments($request);
            $data = null;
            if (count($attachments) > 0) {
                $insertedIds = $this->attachmentRepo->saveInBulk($attachments);
                //dd(serialize($ids)); die();
                $data = serialize($insertedIds);
            }

    		return response()->json(array(
                'success' => true,
                'data' => $data,
                'errors' => []
            ), 200);

    	} catch(\Exception $e) {
    		return response()->json(array(
                'success' => false,
                'data' => 'Server error happened',
                'errors' => $e
            ), 200);
    	}
    }

    /**
     * We are categorizing uploaded files. Since we can't attach data to immutable javascript file objects, we have to
     * send a nested array where the second array (with key = 1) will hold custom data, such as category ID of that file
     * 
     * @param  Request $request 
     * @return array          
     */
    public function processAttachments($request)
    {
        $attachments_input = $request->input('attachments');
        $attachments_files = $request->file('attachments');
        $attachments = [];

        if (count($attachments_files)) {
            foreach ($attachments_files as $key => $value) {
                //$category_id = $attachments_input[$key][1] != 'undefined' ? $attachments_input[$key][1] : NULL;
                $value[0]->category_id = NULL;
                array_push($attachments, $value[0]);
            }
        }

        return $attachments;
    }
}
