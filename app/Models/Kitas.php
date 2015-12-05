<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Kitas extends \Eloquent {

	use SoftDeletes;

	protected $table = 'kitas';
	protected $guarded = array('id', 'deleted_at');
	protected $fillable = array('issued', 'expired', 'doc_number', 'sequence', 'file_url', 'employee_id', 'version');

	public static $rules = array(
		'issued' => 'date',
		'expired' => 'required|date',
		'sequence' => 'integer',
		'employee_id' => 'required|integer',
		'file_url' => 'max:255',
		'doc_number' => 'max:50'
	);

	public function employee()
	{
		return $this->belongsTo('App\Models\Employee');
	} 

	public function documents()
	{
		return $this->hasMany('App\Models\Document');
	}
}
?>