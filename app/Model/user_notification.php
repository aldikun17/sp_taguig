<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\received_document as received_document;

use App\Model\user as user;


class user_notification extends Model
{
    
	protected $table = 'user_notifications';

	protected $hidden = [ 'id' ];

	protected $fillable = [

		'user_id',

		'tracking_id',

		'message',

		'status'

	];


	public function received_document()
	{

		return $this->belongsTo( received_document::class, 'user_id' , 'user_id' );

	}

	public function user()
	{

		return $this->belongsTo( user::class, 'user_id' , 'user_id' );

	}


}
