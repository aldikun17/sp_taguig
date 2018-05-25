<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class received_documents extends Model
{
    
	protected $table = 'received_documents';

	protected $fillable	= [

		'tracking',

		'count_tracking',

		'person_received',

	];

	protected $hidden = [ 'id' ];

}
