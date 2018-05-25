<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

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


}
