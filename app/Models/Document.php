<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends \Eloquent {

	use SoftDeletes;

	protected $guarded = array('id', 'deleted_at');
	protected $fillable = array('issued', 'expired', 'doc_number', 'sequance', 'type_id', 'file_url', 'employee_id');

	public static $rules = array(
		'issued' => 'date',
		'expired' => 'required|date',
		'sequance' => 'integer',
		'type_id' => 'required|integer',
		'employee_id' => 'required|integer',
		'file_url' => 'max:255',
		'doc_number' => 'max:50'
	);

	public function employee()
	{
		return $this->belongsTo('App\Models\Employee');
	} 
}
?>