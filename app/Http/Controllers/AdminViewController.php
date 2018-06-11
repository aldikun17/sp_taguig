<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\category_document as category_document;

use App\Model\document as document;

use App\Model\Request_Document as request_document;

use App\Model\document_tracking as document_tracking;

use App\Model\received_document as received_document;

class AdminViewController extends Controller
{
    
	public function admin_view()
	{

		$received_document  = received_document::where('status',1)->groupBy('tracking_id')->get();

		return view('admin.dashboard', compact( 'received_document' ) );
		
	}


	public function category_document_view()
	{

		$category_document = category_document::orderBy('created_at')->get();

		return view('admin.category_document.category_document', compact( 'category_document' ) );


	}

	public function create_document_view()
	{

		$category_document = category_document::all();

		$documents = document::all();

		$data = compact( 

			'category_document',

			'documents'

		);

		return view('admin.document.document', $data);

	}

	public function create_document()
	{

		$category_document = category_document::all();

		return view('admin.document.create_document.create_document', compact( 'category_document' ));


	}

	public function tracking_view()
	{

		$received_document = received_document::where('status',0)->get();

		return view('admin.document_tracking.document_tracking' , compact( 'received_document' ) );

	}

	public function document_request()
	{

		$document_category = category_document::all();

		$request_document  = request_document::select('*')->groupBy('request_no')->get();

		$year = date('Y');

		$month = date('m');


		return view('admin.document_request.document_request', compact( 'document_category' , 'request_document' , 
			'year' , 'month' ) );

	}

	public function update_request($request_no)
	{

		$document_category = category_document::all();

		$request_document  = request_document::where('request_no',$request_no)->get();

		$request_documents  = request_document::where('request_no',$request_no)->first();

		return view('admin.document_request.update_document_request', compact( 'request_no' , 'request_document', 'document_category', 'request_documents' ) );


	}




}
