<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\Document as document;

use App\Model\document_tracking as document_tracking;

use App\user as users;

class request_document extends Model
{
    
	protected $table = 'request_documents';

	protected $fillable = [

		'request_no',

		'document_no',

		'receiver',

		'soft_delete',
		
		'status'

	];

	protected $hidden = [ 'id' ];

	public function documents()
	{

		return $this->hasMany( document::class , 'document_no' , 'document_no');

	}

	public function get_category()
	{

		return $this->hasOne( document::class, 'document_no', 'document_no' );

	}

	public function document_tracking()
	{

		return $this->belongsTo( document_tracking::class, 'request_no', 'request_no' );

	}

	public function document_trackings()
	{

		return $this->belongsTo( document_tracking::class, 'request_no', 'request_no' );

	}

	public function users()
	{

		return $this->hasOne( users::class, 'user_id' , 'user_id' );

	}
    
}
