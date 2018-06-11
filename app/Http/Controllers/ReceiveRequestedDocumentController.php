<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use Response;

use App\Model\document_tracking as document_tracking;

use App\Model\received_document as received_document;

use App\Model\request_document as request_document;

class ReceiveRequestedDocumentController extends Controller
{
    
	public function receive_validate(Request $request,$request_no = null)
	{

		$receive_document = Validator::make($request->all(),[


			'person_received'   => 'required|min:14|max:64',

			'reason_requesting' => 'required|min:10|max:64'

		]);	

		if($receive_document->fails())
		{

			return Response::json([

				'errors' => $receive_document->errors()->all()

			]);

		}

		$check_document_tracking = document_tracking::where('request_no',$request_no)->first();

		$approved_received_document = $check_document_tracking::find($check_document_tracking->id)->received_documents->last();

		if(empty($approved_received_document))
		{

			return $this->update_tracking($request->all(),$request_no);	
			
		}	else {

			return $this->check_receive_count($request->all(),$request['tracking_id']);

		}

			

			

	}

	public function update_tracking($request,$request_no)
	{

		$tracked_document = document_tracking::where('request_no',$request_no)->first();

		$update_document_tracked = document_tracking::find($tracked_document->id);

		$update_document_tracked->date_received = date("Y-m-d H:i:s");

		$update_document_tracked->confirmed		= 1;	

		$update_document_tracked->save();

		return $this->received($request,$request_no);

	}


	public function received($request,$tracking_id = null)
	{

		$tracking_count = $tracking_id + 1;

		if(!empty($tracking_id)){

			$receive_document = new received_document;

			$receive_document->tracking_id 		 = $request['tracking_id'];

			$receive_document->count_tracking	 = $tracking_count;

			$receive_document->person_received   = $request['person_received'];

			$receive_document->reason_requesting = $request['reason_requesting'];

			$receive_document->status 			 = 0;

			$receive_document->save();

		}	else {

			$receive_document = new received_document;

			$receive_document->tracking_id 		 = $request['tracking_id'];

			$receive_document->count_tracking	 = 1;

			$receive_document->person_received   = $request['person_received'];

			$receive_document->reason_requesting = $request['reason_requesting'];

			$receive_document->status 			 = 0;

			$receive_document->save();

			

		}


		return Response::json([

			'success' => $request['person_received']. ' successfully received the documents with the '. $request['tracking_id']

		]);

	}

	public function check_receive_count($request,$tracking_id)
	{

		$received_document = received_document::where('tracking_id',$tracking_id)->get();

		foreach($received_document as $doc_req):

			

		endforeach;

		return $this->received($request,$doc_req['count_tracking']);

	}

	public function approved_received($tracking,$count)
	{

		$document_tracking = document_tracking::where('request_no',$tracking)->first();

		$received_document = received_document::where('tracking_id',$document_tracking->tracking_id)
											  ->where('count_tracking',$count)->first();


		$approved_received_document = received_document::find($received_document->id);

		$approved_received_document->status = 1;

		$approved_received_document->save();

		return back()->with('approved_success','Document Received with tracking # of '. $received_document->tracking_id);

	}


}
