<?php namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Kitas;
use App\Models\Rptka;
use App\Models\Document;
use App\Models\DocumentType;
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
		$dateKitas = $date->addMonths(1);
		$kitases = Kitas::where('expired', '<', $dateKitas)->get();
		return view('expired/listKitas')
			->with('kitases', $kitases);
	}

	public function getPassport()
	{
		$date = Carbon::today();
		$datePassport = $date->addMonths(12);
		$employees = Employee::where('passport_expired', '<', $datePassport)->get();
		return view('expired/listPassport')
			->with('employees', $employees);
	}
	
	public function getRptka()
	{
		$date = Carbon::today();
		$dateRptka = $date->addMonths(3);
		$rptkas = Rptka::where('expired', '<', $dateRptka)->get();
		return view('expired/listRptka')
			->with('rptkas', $rptkas);
	}

	public function getImta()
	{
		$date = Carbon::today();
		$dateImta = $date->addMonths(2);
		$imtaId = DocumentType::where('name', '=', 'IMTA')->first()->id;
		$imtas = Document::where('document_type_id', '=', $imtaId)->where('expired', '<', $dateImta)->get();
		return view('expired/listImta')
			->with('imtas', $imtas);
	}
}
?>