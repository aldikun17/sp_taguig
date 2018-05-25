<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\Document as document;

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

	public function document()
	{

		return $this->hasMany( document::class , 'document_no' , 'document_no');

	}
    
}
