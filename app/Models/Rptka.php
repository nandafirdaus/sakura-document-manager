<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Rptka extends \Eloquent {

	use SoftDeletes;

	protected $table = 'rptka';
	protected $guarded = array('id', 'deleted_at');
	protected $fillable = array('issued', 'expired', 'doc_number', 'file_url', 'company_id');

	public static $rules = array(
		'issued' => 'date',
		'expired' => 'required|date',
		'company_id' => 'required|integer',
		'file_url' => 'max:255',
		'doc_number' => 'max:50'
	);

	public function employee()
	{
		return $this->hasMany('App\Models\Employee');
	} 

	public function company()
	{
		return $this->belongsTo('App\Models\Company');
	}
}
?>