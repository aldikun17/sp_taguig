<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Model\received_document as received_document;

use App\Model\category_document as category_document;

use App\Model\Document as document;

use App\Model\user_notification as user_notification;

use App\Model\request_document as request_document;

use Auth;

use Response;

class UserViewController extends Controller
{
    
	public function dashboard()
	{

		$user_count_notification = user_notification::where('user_id',Auth::user()->user_id)
													->where('status',1)
													->count('id');

		$user_notification 		 = user_notification::where('user_id',Auth::user()->user_id)
													->where('status',1)
													->get();


		$received_document = received_document::where('user_id',Auth::user()->user_id)
											  ->where('status',1)
											  ->groupBy('tracking_id')
											  ->get();

		return view('user.user_dashboard' , compact( 'received_document' , 'user_count_notification' , 'user_notification' ));

	}

	public function documents()
	{

		$category_document = category_document::all();

		return view('user.documents.create_request', compact( 'category_document' ) );

	}

	public function getCategories($document_no,$filter = null)
	{

		if(!empty($filter))
		{

			$documents = document::where('document_category_id',$document_no)
								 ->where('office','LIKE','%'. $filter . '%')
								 ->orwhere('name','LIKE','%'.$filter.'%')
								 ->orwhere('document_content',$filter)
								 ->get();

		}
		else
		{

			$documents = document::where('document_category_id',$document_no)->get();

		}

		return Response::json([

			'documents' => $documents

		]);

	}

	public function update_Notification($user_id)
	{

		$user_notification = user_notification::where('user_id',$user_id)->first();

		$update_notif = user_notification::find($user_notification->id);

		$update_notif->status = 0;

		$update_notif->save();



	}


}
