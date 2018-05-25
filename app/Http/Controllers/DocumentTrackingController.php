<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\document_tracking as document_tracking;

use App\Model\request_document as request_document;

use Validator;

use Response;


class DocumentTrackingController extends Controller
{
    
	public function document_tracking_validate(Request $request,$request_no)
	{

		$tracking_validate = Validator::make($request->all(),[

			'tracking_id' => 'required|unique:document_trackings',

			'request_no'  => 'required'

		]);

		if($tracking_validate->fails())
		{

			return Response::json([

				'errors' => $tracking_validate->errors()->all()

			]);

		}

		return $this->tracking_document($request->all(),$request_no);

	}

	public function tracking_document($request,$request_no)
	{

		$request_document = request_document::where('request_no',$request_no)->get();

		foreach($request_document as $document_request):

			$approved_request = request_document::find($document_request->id);

			$approved_request->status = 1;

			$approved_request->save();			

		endforeach;

		$document_tracking = new document_tracking;

		$document_tracking->tracking_id = $request['tracking_id'];

		$document_tracking->request_no  = $request['request_no'];

		$document_tracking->confirmed   = 0;

		$document_tracking->save();		

		return response::json([

			'success'	=> 'Successfully Tracked Document '.$request['tracking_id']

		]);

	}


}
