<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use Response;

use App\Model\Request_Document as request_document;

use App\Model\document_tracking as document_tracking;

use App\Model\Document as document;

class DocumentRequestController extends Controller
{
    
	public function validate_request_document(Request $request, $request_no = null)
	{

		$request_validator = Validator::make($request->all(),[

			'request_no' => 'required|unique:request_documents',

			'document_no'   => 'required',

			'receiver'   => 'required',

		]);

		if($request_validator->fails()){

			return Response::json([
				'errors' => $request_validator->errors()->all()
			]);

		}

		if(!empty($request_no))
		{

			return $this->updated_document_request($request->all(),$request_no);

		}
		else
		{
			return $this->request_document_store($request->all());
		}

	}

	public function request_document_store($request)
	{

			foreach($request['document_no'] as $documents):

				$request_document = new request_document;

				$request_document->request_no  = $request['request_no'];

				$request_document->document_no = $documents;

				$request_document->receiver    = $request['receiver'];

				$request_document->status      = 0;

				$request_document->soft_delete = 1;

				$request_document->save();


			endforeach;

		return Response::json([
			'Success' => 'Document Request Successfully Created' . $request['request_no']
		]);

		
	}

	public function request_action($request_no)
	{

		$request_document = request_document::where('request_no',$request_no)->first();

		$soft_delete_request_document 				= request_document::find($request_document->id);

		switch ($request_document['soft_delete']) {

			case 0:

				$soft_delete_request_document->soft_delete  = 1;

				$soft_delete_request_document->save();

				return back()->with('document_success','You successfully recover '. $request_document->request_no);

				break;
			
			case 1:

				$soft_delete_request_document->soft_delete  = 0;

				$soft_delete_request_document->save();

				return back()->with('soft_delete','You successfully remove '. $request_document->request_no);

				break;

			default:
				# code...
				break;
		}

	}

	public function updated_document_request($request,$request_no)
	{

		$request_document = request_document::where('request_no',$request_no)->get();

		$count = 0;

		foreach($request_document as $documents):

			$index = $count++;

			$update_request_document				=	request_document::find($documents->id);

			$update_request_document->request_no    = $request['request_no'];

			$update_request_document->document_no	= $request['document_no'][$index];

			$update_request_document->receiver		= $request['receiver'];

			$update_request_document->save();


		endforeach;

		return Response::json([

			'success'	=> 'You Successfully Update '.$request['request_no']

		]);

	}

	public function replace_document_request($request_no)
	{

		$request_document = request_document::where('request_no',$request_no)->get();

		foreach($request_document as $request):

			$soft_delete_request_document 				= request_document::find($request->id);

			$soft_delete_request_document->document_no  = null;

			$soft_delete_request_document->save();

		endforeach;

		return redirect('admin/request/update/'.$request_no)->with('document_success','You successfully recover '. $request_no);	

	}


}
