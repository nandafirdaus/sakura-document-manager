<?php namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Kitas;
use App\Models\Company;
use App\Models\Rptka;

use Validator;
use Input;
use Session;
use Redirect;

class RptkaController extends Controller {
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
		$companies = Company::all();

		return view('rptka/create')
			->with('companies', $companies);
	}

	public function postCreate()
	{
		$validator = Validator::make(Input::all(), Rptka::$rules);

		if ($validator->fails()) {
			return Redirect::to('rptka/create')
				->withErrors($validator)
				->withInput(Input::all());
		} else {

			$destinationPath = '';
			$fileName = '';

			if (Input::hasFile('document_file')) {
				$file = Input::file('document_file');
				$destinationPath = 'uploads/documents/';
				$extension = $file->getClientOriginalExtension();
				$fileName = Input::get('company_id') . '-RPTKA-' .  rand(1111,9999) . '.' . $extension;
				$file->move($destinationPath, $fileName);
			}

			$rptka = new Rptka;
			$rptka->issued = date('Y-m-d', strtotime(Input::get('issued')));
			$rptka->expired = date('Y-m-d', strtotime(Input::get('expired')));
			$rptka->doc_number = Input::get('doc_number');
			$rptka->company_id = Input::get('company_id');
			$rptka->file_url = $destinationPath . $fileName;
			$rptka->save();

			Session::flash('message', 'Berhasil menambahkan RPTKA!');
			return Redirect::to('rptka');
		}
	}

	public function getEdit($id)
	{
		$rptka = Rptka::find($id);
		$companies = Company::all();
		$prev = Input::get('prev') == '' ? '' : '?prev=' . Input::get('prev');

		return view('rptka.edit')
		->with('rptka', $rptka)
		->with('companies', $companies)
		->with('prev', $prev);
	}

	public function postEdit($id)
	{
		$validator = Validator::make(Input::all(), Rptka::$rules);

		if ($validator->fails()) {
			return Redirect::to('rptka/' . $id .'/edit')
				->withErrors($validator)
				->withInput(Input::all());
		} else {

			$destinationPath = '';
			$fileName = '';

			if (Input::hasFile('document_file')) {
				$file = Input::file('document_file');
				$destinationPath = 'uploads/documents/';
				$extension = $file->getClientOriginalExtension();
				$fileName = Input::get('company_id') . '-RPTKA-' .  rand(1111,9999) . '.' . $extension;
				$file->move($destinationPath, $fileName);
			}

			$rptka = Rptka::find($id);
			$rptka->issued = date('Y-m-d', strtotime(Input::get('issued')));
			$rptka->expired = date('Y-m-d', strtotime(Input::get('expired')));
			$rptka->doc_number = Input::get('doc_number');
			$rptka->company_id = Input::get('company_id');
			if (Input::hasFile('document_file')) {
				$rptka->file_url = $destinationPath . $fileName;
			}
			$rptka->save();

			Session::flash('message', 'Berhasil menambahkan RPTKA.');
			if (Input::get('prev') != '') {
				return Redirect::to('expired/rptka');				
			} else {
				return Redirect::to('rptka');
			}
		}
	}

	public function getView($id)
	{
		$rptka = Rptka::find($id);
		$prev = Input::get('prev') == '' ? '' : '?prev=' . Input::get('prev');

		return view('rptka.view')
		->with('rptka', $rptka)
		->with('prev', $prev);
	}

	public function getList()
	{
		$rptkas = Rptka::all();

		return view('rptka.list')
		->with('rptkas', $rptkas);
	}

	public function delete($id)
	{
		$rptka = Rptka::find($id);
		$rptka->delete();

		Session::flash('message', 'Berhasil menghapus data.');
		if (Input::get('prev') != '') {
			return Redirect::to('expired/rptka');				
		} else {
			return Redirect::to('rptka');
		}
	}
}
?>