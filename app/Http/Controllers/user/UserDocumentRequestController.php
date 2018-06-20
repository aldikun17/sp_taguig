<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Model\request_document as request_document;

use App\Model\document as document;

use Auth;

use Response;

use Storage;

class UserDocumentRequestController extends Controller
{
    
	public function request_document(Request $request)
	{

		if(empty($request['document_no']))
		{

			return Response::json([

				'errors' => 'document_no is field is required'

			]);

		}

		foreach($request['document_no'] as $user_request_documents):	

			$user_request_document = new request_document;

			$user_request_document->user_id      = Auth::user()->user_id;

			$user_request_document->document_no  = $user_request_documents;

			$user_request_document->receiver 	 = Auth::user()->name;

			$user_request_document->status 		 = 0;

			$user_request_document->soft_delete = 1;

			$user_request_document->save();

		endforeach;	

		return response::json([

			'success' => 'You Successfully Request Documents please wait for admins approval'

		]);

	}

	public function user_document_download($user_id,$document_no)
	{

		$request_to_download  = request_document::where('user_id',$user_id)
											    ->where('document_no',$document_no)
												->first();

		$document_to_download = document::where('document_no',$document_no)->first();

		$link_storage  = storage_path('app/public/documents/'.$document_to_download->category_documents->document_category.'/'.$document_no.'/'.$document_to_download->document_path);

		return response()->download( $link_storage , $document_to_download->document_path, ['Content-Type' => 'application/pdf']);

	}

}
