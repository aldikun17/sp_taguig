<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\document_tracking as document_tracking;

class received_document extends Model
{
    
	protected $table = 'received_documents';

	protected $fillable	= [

		'user_id',

		'tracking_id',

		'count_tracking',

		'person_received',

		'reason_requesting',

		'status'

	];

	protected $hidden = [ 'id' ];

	public function document_tracking()
	{

		return $this->belongsTo( document_tracking::class, 'tracking_id', 'tracking_id');

	}

	public function document_trackings()
	{

		return $this->belongsTo( document_tracking::class, 'tracking_id' , 'tracking_id' );

	}

}
