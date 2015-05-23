<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends \Eloquent {

	use SoftDeletes;

	protected $guarded = array('id', 'deleted_at');
	protected $fillable = array('issued', 'expired', 'doc_number', 'document_type_id', 'file_url', 'kitas_id');

	public static $rules = array(
		'issued' => 'date',
		'expired' => 'date',
		'type_id' => 'required|integer',
		'kitas_id' => 'required|integer',
		'file_url' => 'max:255',
		'doc_number' => 'max:50'
	);

	public function kitas()
	{
		return $this->belongsTo('App\Models\Kitas');
	} 

	public function documentType()
	{
		return $this->belongsTo('App\Models\DocumentType');
	} 

}
?>