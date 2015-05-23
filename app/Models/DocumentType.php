<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentType extends \Eloquent {

	use SoftDeletes;

	protected $table = 'document_type';
	protected $guarded = array('id', 'deleted_at');
	protected $fillable = array('name');

	public static $rules = array(
		'name' => 'required|max:150'
	);

	public function document()
	{
		return $this->hasMany('App\Models\Document');
	}
}
?>