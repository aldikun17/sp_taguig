<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Category_Document;

use App\Model\Document;

use Validator;

use Response;

class AdminDocumentController extends Controller
{
    
	public function updated_created_document($document_no)
	{

		$document = document::where('document_no',$document_no)->first();

		$update_document = document::find($document->id);

		return Response::json($update_document);

	}


	public function create_document(Request $request, $id = null)
	{

		$create_document_validator = Validator::make($request->all(),[

			'document_category_id' => 'required',

			'document_no'		   => 'required|unique:documents',

			'office'			   => 'required',

			'name'				   => 'required',

			'document_content'	   => 'required'

		]);

		if($create_document_validator->fails())
		{

			return Response::json([

				'errors' => $create_document_validator->errors()->all()

			]);

		}

		if(!empty($id))
		{

			return $this->store_updated_document($request->all(),$id);

		}	

			return $this->store_created_document($request->all());

	}

	public function store_created_document($request)
	{

		$create_document = new Document;

		$create_document->document_category_id = $request['document_category_id'];

		$create_document->document_no 		   = $request['document_no'];

		$create_document->office 			   = $request['office'];

		$create_document->name 				   = $request['name'];

		$create_document->soft_delete 		   = 1;

		$create_document->document_content 	   = $request['document_content'];

		$create_document->save();

		return Response::json([

			'success'	=> "You've Successfully Create A New Document"

		]);


	}


	public function store_updated_document($request,$document_no)
	{


		$document_to_update = document::where('document_no',$document_no)->first();

		$update_docu = document::find($document_to_update->id);

		$update_docu->document_category_id = $request['document_category_id'];

		$update_docu->document_no 		   = $request['document_no'];

		$update_docu->office 			   = $request['office'];

		$update_docu->name 				   = $request['name'];

		$update_docu->document_content 	   = $request['document_content'];

		$update_docu->save();

		return Response::json([

			'success' => "You've Successfully Update Document ". $document_no

		]);


	}


	public function document_soft_delete($id)
	{

		$documents = document::where('document_no',$id)->first();

		$soft_delete_document = document::find($documents->id);

		$soft_delete_document->soft_delete = 0;

		$soft_delete_document->save();

		return back()->with('soft_delete','You Temporarily Remove '. $documents->document_content);


	}

	public function recover_document($id)
	{

		$documents = document::where('document_no',$id)->first();

		$soft_delete_document = document::find($documents->id);

		$soft_delete_document->soft_delete = 1;

		$soft_delete_document->save();

		return back()->with('document_success','You Successfully Recover '. $documents->document_content);

	}


}
