<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Document as document;

use App\Model\Category_Document as category_document;

use App\Model\document_tracking as document_tracking;

use App\Model\received_document as received_document;

use Response;

class ReceiverViewController extends Controller
{
 
	public function receiver_dashboard()
	{

		$received_documents = received_document::where('status',1)->groupBy('tracking_id')->get();


		return view('receiver.receiver_dashboard' , compact( 'received_documents' ) );

	}

	public function receiver_document()
	{

		$category_document = category_document::all();

		return view('receiver.documents.receiver_documents', compact( 'document' , 'category_document' ) );

	}

	public function receiver_ajax_document($document_no,$filter = null)
	{

		if(empty($filter))
		{
			$return_documents = document::where('document_category_id',$document_no)->get();
		}
		else
		{
			$return_documents = document::where('document_category_id',$document_no)
									->where('document_no','LIKE','%'.$filter.'%')
									->orWhere('office','LIKE','%'.$filter.'%')
									->orWhere('name','LIKE','%'.$filter.'%')
									->orWhere('document_content','LIKE','%'.$filter.'%')->get();
		}

		return response::json([

			'documents' => $return_documents

		]);

	}

	public function documents_to_received()
	{

		$document_tracking = document_tracking::all();

		return view('receiver.documents.tracking.received_document_tracking', compact( 'document_tracking' ) );

	}

}
