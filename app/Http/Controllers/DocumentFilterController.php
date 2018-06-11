<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\document as document;

use App\Model\category_document as category_document;

use Response;

class DocumentFilterController extends Controller
{
    
	public function filter_document($category_id,$document_no,$content = null)
	{
		if(!empty($content))
		{

			$document = document::where('document_category_id',$category_id)
								->where('document_no','LIKE','%'.$document_no.'%')
								->where('document_content','LIKE','%'.$content.'%')->get();

		}	else {

			$document = document::where('document_category_id',$category_id)
								->where('document_no','LIKE','%'.$document_no.'%')->get();

		}

		return Response::json([
			'documents' => $document
		]);

	}

	public function filter_document_content($category_id,$document_content = null)
	{

		$document = document::where('document_category_id',$category_id)
							->where('document_content','LIKE','%'.$document_content.'%')->get();

		return Response::json([
			'documents' => $document
		]);


	}

	public function filter_document_created_at($category_id,$date = null)
	{

		$document = document::where('document_category_id',$category_id)
							->whereDate('created_at',$date)->get();

		return Response::json([
			'documents' => $document
		]);

	}


	public function filter_full($category_id,$document_no,$content,$date)
	{

		$document = document::where('document_category_id',$category_id)
							->where('document_no','LIKE','%'.$document_no.'%')
							->where('document_content','LIKE','%'.$content.'%')
							->whereDate('created_at',$date)->get();

		return Response::json([
			'documents' => $document
		]);

	}

	public function filter_document_category($category_id)
	{

		$document = document::where('document_category_id',$category_id)->get();

		$document_category = category_document::where('document_no',$category_id)->first();

		return Response::json([

			'document_category' => $document_category,

			'documents' => $document

		]);

	}


}
