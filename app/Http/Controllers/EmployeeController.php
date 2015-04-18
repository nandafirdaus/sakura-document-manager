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
			$employee = new Employee;
			$employee->name = Input::get('name');
			$employee->position = Input::get('position');
			$employee->company_id = Input::get('company_id');
			$employee->save();

			Session::flash('message', 'Berhasil menambahkan karyawan!');
			return Redirect::to('employee');
		}
	}

	public function getEdit($id)
	{
		$employee = Employee::find($id);
		$companies = Company::all();

		return view('employee.edit')
		->with('employee', $employee)
		->with('companies', $companies);
	}

	public function postEdit($id)
	{
		$validator = Validator::make(Input::all(), Employee::$rules);

		if ($validator->fails()) {
			return Redirect::to('employee/' . $id .'/edit')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			$employee = Employee::find($id);
			$employee->name = Input::get('name');
			$employee->position = Input::get('position');
			$employee->company_id = Input::get('company_id');
			$employee->save();

			Session::flash('message', 'Berhasil menyimpan karyawan.');
			return Redirect::to('employee');
		}
	}

	public function getView($id)
	{
		$employee = Employee::find($id);

		return view('employee.view')
		->with('employee', $employee);
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
		return Redirect::to('employee');
	}
}
?>