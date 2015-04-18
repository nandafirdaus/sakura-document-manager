<?php namespace App\Http\Controllers;

use App\Models\Company;
use Validator;
use Input;
use Session;
use Redirect;

class CompanyController extends Controller {
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
		return view('company/create');
	}

	public function postCreate()
	{
		$validator = Validator::make(Input::all(), Company::$rules);

		if ($validator->fails()) {
			return Redirect::to('company/create')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			$company = new Company;
			$company->name = Input::get('name');
			$company->address = Input::get('address');
			$company->save();

			Session::flash('message', 'Berhasil menambahkan perusahaan!');
			return Redirect::to('company');
		}
	}

	public function getEdit($id)
	{
		$company = Company::find($id);

		return view('company.edit')
		->with('company', $company);
	}

	public function postEdit($id)
	{
		$validator = Validator::make(Input::all(), Company::$rules);

		if ($validator->fails()) {
			return Redirect::to('company/' . $id .'/edit')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			$company = Company::find($id);
			$company->name = Input::get('name');
			$company->address = Input::get('address');
			$company->save();

			Session::flash('message', 'Berhasil menyimpan perusahaan.');
			return Redirect::to('company');
		}
	}

	public function getView($id)
	{
		$company = Company::find($id);

		return view('company.view')
		->with('company', $company);
	}

	public function getList()
	{
		$companies = Company::all();

		return view('company.list')
		->with('companies', $companies);
	}

	public function delete($id)
	{
		$company = Company::find($id);
		$company->delete();

		Session::flash('message', 'Berhasil menghapus data.');
		return Redirect::to('company');
	}
}
?>