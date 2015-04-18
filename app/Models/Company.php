<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends \Eloquent {

	use SoftDeletes;

	protected $guarded = array('id', 'deleted_at');
	protected $fillable = array('name', 'address');

	public static $rules = array(
		'name' => 'required|max:150',
		'address' => 'max:500'
	);

	public function employee()
	{
		return $this->hasMany('App\Models\Employee');
	} 
}
?>