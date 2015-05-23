<?php namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Kitas;
use App\Models\Rptka;
use Carbon\Carbon;
use Validator;
use Session;
use Redirect;

class ExpiredController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getKitas()
	{
		$date = Carbon::today();
		$dateKitas = $date->addMonths(2);
		$kitases = Kitas::where('expired', '<', $dateKitas)->get();
		return view('expired/listKitas')
			->with('kitases', $kitases);
	}

	public function getPassport()
	{
		$date = Carbon::today();
		$datePassport = $date->addMonths(18);
		$employees = Employee::where('passport_expired', '<', $datePassport)->get();
		return view('expired/listPassport')
			->with('employees', $employees);
	}
	
	public function getRptka()
	{
		$date = Carbon::today();
		$dateRptka = $date->addWeek();
		$rptkas = Rptka::where('expired', '<', $dateRptka)->get();
		return view('expired/listRptka')
			->with('rptkas', $rptkas);
	}
}
?>