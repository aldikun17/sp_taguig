<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\category_document;

use Response;

use Validator;

class DocumentCategoryController extends Controller
{
    
	public function validate_document_category(Request $request, $cat_doc = null)
	{
		$document_validator = Validator::make($request->all(),[

			'document_no' 		=> 'required|unique:category_documents',

            'document_category' => 'required|unique:category_documents'

		]);

		if($document_validator->fails())
		{
			return Response::json([
				'errors' => $document_validator->errors()->all()
			]);
		}

		if(!empty($cat_doc))
		{
			return $this->update_document_category($request->all(),$cat_doc);
		}

			return $this->store_document_category($request->all());

	}

	public function store_document_category($request)
	{

		$category_document = new Category_Document;

		$category_document->document_no        = $request['document_no'];

		$category_document->document_category  = $request['document_category'];

		$category_document->soft_delete 	   = 1;

		$category_document->save();

		return Response::json(['success' => "You've Successfully Created a Document Category"]);


	}

	public function update_document_category($request,$id)
	{

		$category_document = category_document::where('document_no',$id)->first();

		$update_document_category = category_document::find($category_document->id);
		$update_document_category->document_no			= $request['document_no'];
		$update_document_category->document_category 	= $request['document_category'];
		$update_document_category->save();

		return Response::json(['success' => "You've Successfully Update a Document Category"]);

	}

	public function ajax_document_category_update($document_no)
	{

		$category_document = category_document::where('document_no',$document_no)->first();

		$update_document_category = category_document::find($category_document->id);
		
		return Response::json($update_document_category);	


	}

	public function soft_delete_document_category($id)
	{

		$category_document_soft_delete 	= category_document::where('document_no',$id)->first();

		$category_document 				= category_document::find($category_document_soft_delete['id']);

		$category_document->soft_delete = 0;

		$category_document->save();

		return back()->with('soft_delete', 'You temporarily Delete '. $category_document_soft_delete->document_category);

	}

	public function recover_document_category($id)
	{

		$category_document_soft_delete 	= category_document::where('document_no',$id)->first();

		$category_document 				= category_document::find($category_document_soft_delete['id']);

		$category_document->soft_delete = 1;

		$category_document->save();

		return back()->with('document_success', 'You temporarily Delete '. $category_document_soft_delete->document_category);

	}



}
