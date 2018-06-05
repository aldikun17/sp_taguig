<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\document_tracking as document_tracking;

class received_document extends Model
{
    
	protected $table = 'received_documents';

	protected $fillable	= [

		'tracking',

		'count_tracking',

		'person_received',

		'status'

	];

	protected $hidden = [ 'id' ];

	public function document_tracking()
	{

		return $this->belongsTo( document_tracking::class, 'tracking_id', 'tracking_id');

	}

	public function tracking_document()
	{

		return $this->belongsTo( document_tracking::class, 'tracking_id', 'tracking_id');

	}

}
