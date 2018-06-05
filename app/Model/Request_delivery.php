<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Request_delivery extends Model
{
    
	protected $table = 'request_document';

	protected $fillable = [

		'request_no',
		'document_no',
		'receiver',
		'status'

	];

	protected $fillable = [ 'id' ];

}
