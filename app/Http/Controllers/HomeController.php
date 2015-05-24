<?php namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Kitas;
use App\Models\Rptka;
use Carbon\Carbon;
use Redirect;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$dateKitas = Carbon::today()->addMonths(2);
		$datePassport = Carbon::today()->addMonths(18);
		$dateRptka = Carbon::today()->addWeek();
		$kitas = Kitas::where('expired', '<', $dateKitas)->count();
		$passport = Employee::where('passport_expired', '<', $datePassport)->count();
		$rptka = Rptka::where('expired', '<', $dateRptka)->count();
		return view('home')
		->with('kitas', $kitas)
		->with('passport', $passport)
		->with('rptka', $rptka);
	}

	public function redirect()
	{
		return Redirect::to('/');
	}

}
