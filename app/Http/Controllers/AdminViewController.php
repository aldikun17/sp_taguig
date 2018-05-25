<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\category_document as category_document;

use App\Model\document as document;

use App\Model\Request_Document as request_document;

use App\Model\document_tracking as document_tracking;

class AdminViewController extends Controller
{
    
	public function admin_view()
	{

		$document_tracking  = document_tracking::orderBy('created_at');

		return view('admin.dashboard', compact( 'document_tracking' ) );
		
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

	public function tracking_view()
	{

		$document = document::all();

		return view('admin.document_tracking.document_tracking' , compact( 'document' ) );

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
