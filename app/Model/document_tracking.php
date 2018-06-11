<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\request_document as request_document;

use App\Model\received_document as received_document;

class document_tracking extends Model
{
    
	protected $table = 'document_trackings';

	protected $fillable = [
		
		'tracking_id',

		'request_no',

		'date_received',

		'confirmed',

	];

	protected $hidden = [	'id'	];

	public function request_document()
	{

		return $this->hasOne( request_document::class, 'request_no' , 'request_no' );

	}

	public function request_documents()
	{

		return $this->hasMany( request_document::class, 'request_no' , 'request_no' );

	}

	public function received_document()
	{

		return $this->hasOne( received_document::class, 'tracking_id' , 'tracking_id' );

	}


	public function received_documents()
	{

		return $this->hasMany( received_document::class, 'tracking_id' , 'tracking_id' );

	}

}
