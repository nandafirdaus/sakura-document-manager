<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends \Eloquent {

	use SoftDeletes;

	protected $guarded = array('id', 'deleted_at');
	protected $fillable = array('name', 'position', 'company_id');

	public static $rules = array(
		'name' => 'required|max:150',
		'position' => 'max:150',
		'company_id' => 'required'
	);

	public function company()
	{
		return $this->belongsTo('App\Models\Company');
	}

	public function document()
	{
		return $this->hasMany('App\Models\Document');
	}
}
?>