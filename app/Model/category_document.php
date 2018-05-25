<?php

namespace App\Model;

use App\Model\document;

use Illuminate\Database\Eloquent\Model;

class category_document extends Model
{
    
	protected $table = 'category_documents';

	protected $fillable = [ 
		'document_no' , 
		'document_category' ,
		'soft_delete'
	];

	protected $hidden = [ 'id' ];

	public function document()
	{

		return $this->belongsTo(document::class);

	}

}
