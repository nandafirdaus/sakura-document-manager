<?php namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Kitas;
use App\Models\Company;
use App\Models\Employee;

use Validator;
use Input;
use Session;
use Redirect;

class KitasController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getCreate() 
	{
		$employees = Employee::all();

		return view('kitas/create')
			->with('employees', $employees);
	}

	public function postCreate()
	{
		$validator = Validator::make(Input::all(), Kitas::$rules);

		if ($validator->fails()) {
			return Redirect::to('kitas/create')
				->withErrors($validator)
				->withInput(Input::all());
		} else {

			$destinationPath = '';
			$fileName = '';

			if (Input::hasFile('document_file')) {
				$file = Input::file('document_file');
				$destinationPath = 'uploads/documents/';
				$extension = $file->getClientOriginalExtension();
				$fileName = Input::get('employee_id') . '-KITAS-' . Input::get('sequence') . '-' .  rand(1111,9999) . '.' . $extension;
				$file->move($destinationPath, $fileName);
			}

			$kitas = new Kitas;
			$kitas->issued = date('Y-m-d', strtotime(Input::get('issued')));
			$kitas->expired = date('Y-m-d', strtotime(Input::get('expired')));
			$kitas->doc_number = Input::get('doc_number');
			$kitas->sequence = Input::get('sequence');
			$kitas->employee_id = Input::get('employee_id');
			$kitas->file_url = $destinationPath . $fileName;
			$kitas->save();

			Session::flash('message', 'Berhasil menambahkan KITAS!');
			return Redirect::to('kitas');
		}
	}

	public function getEdit($id)
	{
		$kitas = Kitas::find($id);
		$employees = Employee::all();
		$prev = Input::get('prev') == '' ? '' : '?prev=' . Input::get('prev');

		return view('kitas.edit')
		->with('kitas', $kitas)
		->with('employees', $employees)
		->with('prev', $prev);
	}

	public function postEdit($id)
	{
		$validator = Validator::make(Input::all(), Kitas::$rules);

		if ($validator->fails()) {
			return Redirect::to('kitas/' . $id .'/edit')
				->withErrors($validator)
				->withInput(Input::all());
		} else {

			$destinationPath = '';
			$fileName = '';

			if (Input::hasFile('document_file')) {
				$file = Input::file('document_file');
				$destinationPath = 'uploads/documents/';
				$extension = $file->getClientOriginalExtension();
				$fileName = Input::get('employee_id') . '-KITAS-' . Input::get('sequence') . '-' .  rand(1111,9999) . '.' . $extension;
				$file->move($destinationPath, $fileName);
			}

			$kitas = Kitas::find($id);
			$kitas->issued = date('Y-m-d', strtotime(Input::get('issued')));
			$kitas->expired = date('Y-m-d', strtotime(Input::get('expired')));
			$kitas->doc_number = Input::get('doc_number');
			$kitas->sequence = Input::get('sequence');
			$kitas->employee_id = Input::get('employee_id');
			if (Input::hasFile('document_file')) {
				$kitas->file_url = $destinationPath . $fileName;
			}
			$kitas->save();

			Session::flash('message', 'Berhasil menambahkan KITAS.');
			
			if (Input::get('prev') != '') {
				return Redirect::to('expired/kitas');				
			} else {
				return Redirect::to('kitas');
			}
		}
	}

	public function getView($id)
	{
		$kitas = Kitas::find($id);
		$documents = $kitas->documents;
		$prev = Input::get('prev') == '' ? '' : '?prev=' . Input::get('prev');

		return view('kitas.view')
		->with('kitas', $kitas)
		->with('documents', $documents)
		->with('prev', $prev);
	}

	public function getList()
	{
		$kitases = Kitas::all();

		return view('kitas.list')
		->with('kitases', $kitases);
	}

	public function delete($id)
	{
		$kitas = Kitas::find($id);
		$kitas->delete();

		Session::flash('message', 'Berhasil menghapus data.');
		if (Input::get('prev') != '') {
			return Redirect::to('expired/kitas');				
		} else {
			return Redirect::to('kitas');
		}
	}
	
}
?>