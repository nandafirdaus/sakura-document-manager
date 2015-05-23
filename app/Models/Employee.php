<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends \Eloquent {

	use SoftDeletes;

	protected $guarded = array('id', 'deleted_at');
	protected $fillable = array('name', 'position', 'company_id', 'passport_number', 'passport_issued', 'passport_expired', 'passport_file_url', 'rptka_id');

	public static $rules = array(
		'name' => 'required|max:150',
		'position' => 'max:150',
		'company_id' => 'required',
		'passport_expired' => 'date',
		'passport_issued' => 'date',
		'passport_file_url' => 'max:255',
		'rptka_id' => 'integer',
	);

	public function company()
	{
		return $this->belongsTo('App\Models\Company');
	}

	public function kitas()
	{
		return $this->hasOne('App\Models\Kitas');
	}

	public function rptka()
	{
		return $this->belongsTo('App\Models\Rptka');
	}
}
?>