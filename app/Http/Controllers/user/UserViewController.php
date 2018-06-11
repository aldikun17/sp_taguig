<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Model\received_document as received_document;

use App\Model\category_document as category_document;

use Auth;

class UserViewController extends Controller
{
    
	public function dashboard()
	{

		$received_document = received_document::where('user_id',Auth::user()->user_id)
											  ->where('status',1)
											  ->groupBy('tracking_id')
											  ->get();

		return view('user.user_dashboard' , compact( 'received_document' ));

	}

	public function documents()
	{

		$category_document = category_document::all();

		return view('user.documents.create_request', compact( 'category_document' ) );

	}


}
