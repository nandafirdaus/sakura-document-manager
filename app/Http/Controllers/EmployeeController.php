<?php namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Validator;
use Input;
use Session;
use Redirect;

class EmployeeController extends Controller {
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
		return view('employee/create')
			->with('companies', $companies);
	}

	public function postCreate()
	{
		$validator = Validator::make(Input::all(), Employee::$rules);

		if ($validator->fails()) {
			return Redirect::to('employee/create')
				->withErrors($validator)
				->withInput(Input::all());
		} else {

			$destinationPath = '';
			$fileName = '';

			if (Input::hasFile('passport_file')) {
				$file = Input::file('passport_file');
				$destinationPath = 'uploads/documents/';
				$extension = $file->getClientOriginalExtension();
				$fileName = Input::get('company_id') . '-passport-' .  rand(1111,9999) . '.' . $extension;
				$file->move($destinationPath, $fileName);
			}

			$employee = new Employee;
			$employee->name = Input::get('name');
			$employee->position = Input::get('position');
			$employee->company_id = Input::get('company_id');
			if (Input::get('passport_issued') != '') {
				$employee->passport_issued = date('Y-m-d', strtotime(Input::get('passport_issued')));
			}
			if (Input::get('passport_expired') != '') {
				$employee->passport_expired = date('Y-m-d', strtotime(Input::get('passport_expired')));
			}
			if (Input::get('rptka_id') != '') {
				$employee->rptka_id = Input::get('rptka_id');
			}
			$employee->passport_number = Input::get('passport_number');
			if (Input::hasFile('passport_file')) {
				$employee->passport_file_url = $destinationPath . $fileName;
			}

			$employee->save();

			Session::flash('message', 'Berhasil menambahkan karyawan!');
			return Redirect::to('employee');
		}
	}

	public function getEdit($id)
	{
		$employee = Employee::find($id);
		$companies = Company::all();
		$prev = Input::get('prev') == '' ? '' : '?prev=' . Input::get('prev');

		return view('employee.edit')
		->with('employee', $employee)
		->with('companies', $companies)
		->with('prev', $prev);
	}

	public function postEdit($id)
	{
		$validator = Validator::make(Input::all(), Employee::$rules);

		if ($validator->fails()) {
			return Redirect::to('employee/' . $id .'/edit')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			$destinationPath = '';
			$fileName = '';

			if (Input::hasFile('passport_file')) {
				$file = Input::file('passport_file');
				$destinationPath = 'uploads/documents/';
				$extension = $file->getClientOriginalExtension();
				$fileName = Input::get('company_id') . '-passport-' .  rand(1111,9999) . '.' . $extension;
				$file->move($destinationPath, $fileName);
			}

			$employee = Employee::find($id);
			$employee->name = Input::get('name');
			$employee->position = Input::get('position');
			$employee->company_id = Input::get('company_id');
			if (Input::get('rptka_id') != '') {
				$employee->rptka_id = Input::get('rptka_id');
			} else {
				$employee->rptka_id = null;
			}
			if (Input::get('passport_issued') != '') {
				$employee->passport_issued = date('Y-m-d', strtotime(Input::get('passport_issued')));
			} else {
				$employee->passport_issued = null;
			}
			if (Input::get('passport_expired') != '') {
				$employee->passport_expired = date('Y-m-d', strtotime(Input::get('passport_expired')));
			} else {
				$employee->passport_expired = null;
			}
			$employee->passport_number = Input::get('passport_number');
			if (Input::hasFile('passport_file')) {
				$employee->passport_file_url = $destinationPath . $fileName;
			}
			$employee->save();

			Session::flash('message', 'Berhasil menyimpan karyawan.');
			if (Input::get('prev') != '') {
				return Redirect::to('expired/passport');				
			} else {
				return Redirect::to('employee');
			}
		}
	}

	public function getView($id)
	{
		$employee = Employee::find($id);
		$prev = Input::get('prev') == '' ? '' : '?prev=' . Input::get('prev');

		return view('employee.view')
		->with('employee', $employee)
		->with('prev', $prev);
	}

	public function getList()
	{
		$employees = Employee::all();

		return view('employee.list')
		->with('employees', $employees);
	}

	public function delete($id)
	{
		$employee = Employee::find($id);
		$employee->delete();

		Session::flash('message', 'Berhasil menghapus data.');
		if (Input::get('prev') != '') {
			return Redirect::to('expired/passport');				
		} else {
			return Redirect::to('employee');
		}
	}
}
?>