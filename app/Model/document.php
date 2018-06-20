<?php

namespace App\Model;

use App\Model\category_document;

use App\Model\request_document;

use Illuminate\Database\Eloquent\Model;

class document extends Model
{
    
	protected $table = 'documents';

	protected $fillable =  [

		'document_category_id',

		'document_no',

		'office',

		'name',

		'document_content',

		'soft_delete'
		
	];

	protected $hidden = [	'id'	];

	public function category_documents()
	{

		return $this->hasOne( category_document::class, 'document_no' , 'document_category_id' );

	}

	public function request_document()
	{

		return $this->belongsTo(request_document::class, 'document_no' , 'document_no');

	}

	public function get_single_request()
	{

		return $this->belongsTo( request_document::class, 'document_no', 'document_category_id' );

	}

}
